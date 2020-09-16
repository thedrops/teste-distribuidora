$( document ).ready(function() {

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var path = $('meta[name="path"]').attr('content')

  $('#create-city').submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    
    $.ajax({
      url:path+'/cidades',
      method:"POST",
      dataType:"JSON",
      data:data,
      success:function(response){
          console.log(response);
          if(response.status == 'success'){
            Swal.fire(
              'Success',
              response.message,
              'success'
            )
            setTimeout(function(){ $(location).attr('href',path+'/cidades'); }, 3000);
          }else{
            Swal.fire(
              'Error. Try again!',
              response.message,
              'error'
            )
          }
      },
      error:function(err){
          console.log(err);
      }
    });

  });

});