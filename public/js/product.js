$(function() {
  $('.add-button').on('click',function(){
    var name = $(this).parent().prev().prev().find("a").text();
    
    
    $('#table_id').append(`<tr><th><button type="button" class="btn btn-light">削除</button></th><td><input type="text" name="name" value="${name}"></td><td><input type="text" name="url" value="ああ"></td><td><input type="integer" name="JAN-code" value="ああ"></td></tr>`);
  });
});