$(function() {
  $('.add-button').on('click',function(){
    var name = $(this).parent().prev().prev().find("a").text();
    var url = $(this).parent().prev().prev().find("a").attr("href");
    var detail = $(this).parent().text()
    var str = detail.substring(0, detail.indexOf("追加"));
    var jancode = str.slice(str.indexOf("JANコード:") + "JANコード:".length);
    var user_id = $('#user').data();
    $('#table_id').append(`<tr><th><button type="button" class="btn btn-light delete-button">削除</button></th><td><input type="text" name="name[]" value="${name}"></td><td><input type="text" name="url[]" value="${url}"></td><td><input type="integer" name="jancode[]" value="${jancode}"></td><td><input type=hidden name="user_id[]" value="${user_id}"></td></tr>`);
  });

  $(document).on('click','.delete-button', function(){
    $(this).parent().parent().remove();
  })

  $('#edit').toggle();
  $('#toggle').on('click',function(){
    $('#edit').toggle();
    $('#display').toggle();
  })
});