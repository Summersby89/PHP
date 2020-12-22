function setimage() {
  $("#my-form").on("submit", function () {
    var fd = new FormData(form);
    $.ajax({
      url: "/include/upload.php",
      data: fd,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function (data) {
        $("#message").html(data);
      }
    });
  });
}