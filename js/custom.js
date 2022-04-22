$(document).ready(function () {
  // executes when HTML-Document is loaded and DOM is ready
  
  // change the nav bg color on scroll
  $(function () {
    $(document).scroll(function () {
      var $nav = $(".navbar");
      $nav.toggleClass('bg-dark', $(this).scrollTop() > $nav.height());
    });
  });

  
  
  $(function () {
    $("#playlist li").on("click", function () {
      $("#videoarea").attr({
        src: $(this).attr("movieurl")
      });
    });
    $("#videoarea").attr({
      src: $("#playlist li")
        .eq(0)
        .attr("movieurl")
    });
  });
});
