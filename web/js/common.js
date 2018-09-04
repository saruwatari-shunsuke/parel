// Other Event
$(function(){
  //Hover effect
  $('.hover-light').hover(
    function () {
      $(this).addClass('hover-light-on');
    },
    function () {
      $(this).removeClass('hover-light-on');
    }
  );
  //Modal close
  $("#close").click(function () {
    $("div#out").fadeOut("fast");
  });
});


