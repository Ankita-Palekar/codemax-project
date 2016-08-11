$(function(){

  var error_alert = '<div class="alert alert-danger text-center">$error_message</div>';
  var succ_alert = '<div class="alert alert-info text-center">$success_message</div>';
  var messaging_element = $('.message-info');
  $(document).ready(function(){
    $('#manufacturer_form').submit(function(e){
      e.preventDefault();
      var form = $(this);
      name = form.find('#name').val();
      if (!_.isEmpty(name)) { 
        $.ajax({
            url: 'index.php?model=manufacturer&action=add_manufacturer&render=json',
            type: 'post',
            dataType: 'json',
            data: {name: name}
          }).done(function(data){
            if (!_.isEmpty(data.message)) {
              $('.message-info').html(error_alert.replace("$error_message", data.message));
            }else{
              $('.message-info').html('<div class="alert alert-info text-center">Manufacturer added successfully</div>')
              form.find('#name').val('');
            } 
          }).fail(function(){
            $('.message-info').html('<div class="alert alert-danger text-center">There was error while adding manufacturer</div>')
          });
      }else{
        $('.message-info').html('<div class="alert alert-danger text-center">Name cannot be empty</div>')
      }
    })

    $('form#add_car_form').submit(function(e) {
      e.preventDefault();
      var form = $('form#add_car_form');
      var non_numeric_keys = ['name', 'color', 'reg_no', 'note'];
      var numeric_keys = ['manufacturing_year']
      var errors = [];
      
      _.each(non_numeric_keys, function(k){
        if(_.isEmpty(form.find('#'+k).val())){
          errors.push(" field "+ k + " is empty;");
        }
      });

      _.each(numeric_keys, function(k){
        if(_.isNumber(form.find('#'+k).val()) && (form.find('#'+k).val() < 0 )){
          var error_message = errors.push(" field "+ k + " has 0 value;");
          error_message = error_message.replace('$error_message', error_message);
          messaging_element.html(error_message);
        }
      });

      if (errors.length > 0) {
        message = errors.join(", ");
        messaging_element.html()
      }else{
        var form_data = new FormData(form[0]);
        url = "index.php?model=carmodel&action=add_car";
        $.ajax({
            url: url,
            type: 'post',
            data: form_data,
            cache:false,
            processData: false,
            contentType: false
          }).done(function(data){
            if (!_.isEmpty(data.result)) {
              messaging_element.html(succ_alert.replace("$success_message", "model added successfully"));
            }else{
              messaging_element.html(error_alert.replace("$error_message", "modal could not be added please check the error"));
            }  
          });
      }


    })


    var car_compo = `
        <div class="car-div">
          <div class="row">
            <div class="col-md-1 col-md-offset-1">
              <p><strong> Name: </strong></p>
            </div>
            <div class="col-md-1">
              <p> $name </p>
            </div>
            
            <div class="col-md-1 col-md-offset-1">
              <p><strong> Color: </strong></p>
            </div>
            <div class="col-md-1">
              <p> $color </p>
            </div>

            <div class="col-md-1 col-md-offset-1">
              <p><strong> Year: </strong></p>
            </div>
            <div class="col-md-1">
              <p> $manufacturing_year </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 col-md-offset-1">
              <p><strong>Reg-no</strong></p>
            </div>
            <div class="col-md-1">
              <p>
                $reg_no
              </p>
            </div>
            <div class="col-md-1 col-md-offset-1 ">
              <p><strong>Note:</strong></p>
            </div>
            <div class="col-md-5">
              <p>
                $note
              </p>
            </div>
          </div>
          <div class="row">
             
            <div class="col-md-5 col-md-offset-1">
              <div class="car-img-container">
                <img src="$picture1_path" class="img-thumbnail"/>
              </div>
            </div>

            <div class="col-md-5 col-md-offset-1  ">
              <div class="car-img-container">
                <img src="$picture2_path" class="img-thumbnail"/>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-2 col-md-offset-5">
              <button class="btn btn-primary btn-lg" id="sell_car" data-id="$id">Sold Out</button>
            </div>
          </div>
        </div>
        <hr>
    `;

 
    var final_html='';

    $('table>tbody>tr').on('click', function(argument) {
      $('#car_modal').modal('show');
      
      url = "index.php?model=carmodel&action=get_required_cars";
      $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: {ids: $(this).data('ids')},
      }).done(function(data){
        
        var temp = '', final_partial='';
        if (!_.isEmpty(data)) {
          _.each(data, function(car){
            temp = car_compo;
            _.each(car, function(value, key){
              temp = temp.replace('$'+key, value);
            });

            final_partial += temp;
          });

  
          $('#modal_body').html(final_partial);

        }
      });
    })

    $('body').on('click', '#sell_car', function(e){
      var $this= $(this)
      e.preventDefault();
      var url = 'index.php?model=carmodel&action=delete_car'
      $.ajax({
          url: url,
          type: 'post',
          data: {id: $(this).data('id')}
        }).done(function(data){
          $ele = $this.closest('.car-div');
          $ele.html("");
        });
    })
  });
});