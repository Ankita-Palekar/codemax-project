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
            console.log("data", data);
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

  })

})