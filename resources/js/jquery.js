$(function(){
  $('[name=selectMonth]').on('change',function(){
    let selectMonth = $(this).val();

    $.ajax({
      url:"select.php",
      type: "POST",
      dataType: "json",
      data:{
        selectMonth:selectMonth
      }
    }).fail(function(){
      
    })
  });
});