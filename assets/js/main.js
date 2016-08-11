$(function(){
  $(document).ready(function(){
    $('#manufacturer_form').submit(function(e){
      e.preventDefault();
      var form = $(this);
      name = form.find('#name').val();
      if (!_.isEmpty(name)) { 
        $.ajax({
            url: 'index.php?model=manufacturer&action=add_manufacturer&render=json',
            type: 'post',
            data: {name: name},
          }).done(function(data){
            if (!_.isEmpty(data)) {
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
      var form = $('form#add_car_form')[0];
      var form_data = new FormData(form);
      url = "index.php?model=carmodel&action=add_car";
      $.ajax({
          url: url,
          type: 'post',
          data: form_data,
          cache:false,
          processData: false,
          contentType: false
        }).done(function(data){
          if (!_.isEmpty(data)) {
            console.log("I was here");
            $('.message-info').html('<div class="alert alert-danger text-center">There was error while adding manufacturer</div>');
            // form.reset();
          }else{
            $('.message-info').html('<div class="alert alert-danger text-center">There was some error while adding model</div>');
          }
        });

    })


    var car_compo = `
        <div>
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
      e.preventDefault();
      var url = 'index.php?model=carmodel&action=delete_car'
      $.ajax({
          url: url,
          type: 'post',
          data: {id: $(this).data('id')}
        }).done(function(data){
          console.log("this has been deleted");
        });
    })

  })

})