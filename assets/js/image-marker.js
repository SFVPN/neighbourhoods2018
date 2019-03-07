$(document).ready(function() {
    $("img").on("click", function(event) {
        var x = event.pageX - this.offsetLeft;
        var y = event.pageY - this.offsetTop;



        //$(".coords input:text").val("Left Position : " + x + " --- Top Position : " + y);


      //  $(".top input:text").val(y);
        //alert("X Coordinate: " + x + " Y Coordinate: " + y);
    });



});



$(document).ready(function(){
  var fadeDelay = 10000;
  	var fadeDuration = 10000;
    $(".image-wrap img").click(function (ev) {

        var height = $(this).height();
        var width = $(this).width();
        var iwTop = $(this).offset().top;
        var iwLeft = $(this).offset().left;
        var x = ev.pageX - iwLeft + 20;
        var y = ev.pageY - iwTop + 20;
        var perY = Math.floor(y / height * 100);
        var perX = Math.floor(x / width * 100);
        $("body").append(
            $('<div class="marker"></div>').css({
                position: 'absolute',
                top: ev.pageY + 'px',
                left: ev.pageX + 'px',
                width: '20px',
                height: '20px',
                border: '4px solid tomato',
                background: 'pink'
            })
        );
        $(".coords input:text").val("Left Position : " + perX + "% --- Top Position : " + perY + "%");
      
    });

    $(".acf-button-group").click(function(){
   $('.marker').remove();
     $(".coords input:text").val(null);
});

});



$
