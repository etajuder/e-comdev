
function reLoadPlugin() {
  $("#zoom_01").elevateZoom();
}
$("body").on("click", "#extra", function() {
    var target = $("#zoom_01");
    var ez =     $('#zoom_01').data('elevateZoom');
    var src = $(this).attr('src');
    target.attr("src", src);
    target.attr('data-zoom-image', src);
    ez.swaptheimage(src,src);
    //reLoadPlugin();
});

