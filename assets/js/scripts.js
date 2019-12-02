
jQuery(document).ready(function() {
  //  jQuery('.accordion p:empty, .orbit p:empty').remove();

  $('.button-collapse').sideNav({
    menuWidth: 300, // Default is 300
    edge: 'left', // Choose the horizontal origin
    closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
    draggable: true // Choose whether you can drag to open on touch screens
  }
);

$('.collapsible').collapsible();

$('.tooltipped').tooltip();

$(".collapsible-header button").click(function () {
      $(this).text(function(i, text){
          return text === "Hide Audit List" ? "Show Audit List" : "Hide Audit List";
      })
   });


    $('.materialboxed').materialbox();
    $('.modal').modal({
     dismissible: true, // Modal can be dismissed by clicking outside of the modal
     opacity: .8, // Opacity of modal background
     inDuration: 300, // Transition in duration
     outDuration: 200, // Transition out duration
     startingTop: '0%', // Starting top style attribute
     endingTop: '15%', // Ending top style attribute
   }
 );
 //$('.modal-close').modal('close');


  $('select').material_select();
  $('.parallax').parallax();


$(".dropdown-button").click(function(){
  $width = $("li.dropdown").width();
  $(".mdi-menu-down").toggleClass("rotate");
  $(".dropdown-content").toggleClass("block").css("min-width", $("li.dropdown").width());
});
$(".add-image").removeClass("button").addClass("btn");
$("textarea").addClass("materialize-textarea");
//$(".label").removeClass("label").addClass("chip");
$(".field input[value='Report location']").addClass("btn");



   // $('body').on('click','a[href^="#"]',function(event){
   //     event.preventDefault();
   //     var target_offset = $(this.hash).offset() ? $(this.hash).offset().top : 0;
   //     //change this number to create the additional off set
   //     var customoffset = $("header").height();
   //     $('html, body').animate({scrollTop:target_offset - customoffset}, 900);
   // });

// smooth scroll function which does not break skip to content accessibility
   $(function() {
   $('a[href*="#"]:not([href="#"])').click(function() {
     if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
       var target = $(this.hash);
       target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
       if (target.length) {
         $('html, body').animate({
           scrollTop: target.offset().top - 100
         }, 1000);
         target.focus(); // Setting focus
         if (target.is(":focus")){ // Checking if the target was focused
           return false;
         } else {
           target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
           target.focus(); // Setting focus
         };
         return false;
       }
     }
   });
 });

 $(".markers").on("click", function(event) {

    var marker = this;
    var id = $(this).attr("data-id");



    if ( $(this).hasClass('active-marker') ) {
        $(this).removeClass('active-marker');
        $('.markers.active-marker').removeClass('active-marker');
    } else {
        $('.markers.active-marker').removeClass('active-marker');
         $( this ).addClass('active-marker');
    }

    if ( $("#" + id).hasClass('active-desc') ) {
        $(this).removeClass('active-desc');

    } else {
        $('.marker-desc li.active-desc').removeClass('active-desc');
         $( "#" + id ).addClass('active-desc');
    }








     //$(".coords input:text").val("Left Position : " + x + " --- Top Position : " + y);


   //  $(".top input:text").val(y);
     //alert("X Coordinate: " + x + " Y Coordinate: " + y);
 });

   $("#acf-_post_title").attr("placeholder","Please add a title for your submission. Just click on this text and start writing - it will disappear!");


$('.modal').modal({
  dismissible: true, // Modal can be dismissed by clicking outside of the modal,

});


$('#plustext').on('click', function () {
    $('body, p, .chip, span').animate({'font-size': '+=5'});
});

$('#plustext_mob').on('click', function () {
    $('body, p, .chip, span').animate({'font-size': '+=5'});
});

$('#minustext').on('click', function () {
    $('body, p, .chip, span').animate({'font-size': '-=5'});
});


$('#minustext_mob').on('click', function () {
    $('body, p, .chip, span').animate({'font-size': '-=5'});
});

$('#close-modal').on('click', function () {
  $('#modal1').modal('close');
});

$('.acf-actions .acf-button').addClass('btn blue-grey darken-4');
$('.acf-hl .acf-button').addClass('btn blue-grey darken-4');

});
  //var checkbox = document.getElementById('themer');
  var contrast = document.getElementById('themeContrast');
  var contrast_mob = document.getElementById('themeContrast_mob');
  var invertor = document.getElementById('inverter');


  const toggle = document.querySelector('[aria-pressed]');

  contrast.addEventListener('click', (e) => {
   let pressed = e.target.getAttribute('aria-pressed') === 'true';
   e.target.setAttribute('aria-pressed', String(!pressed));
   if(!pressed) {
     invertor.setAttribute('media', 'screen');
     localStorage.setItem("theme", 'screen');
   } else {
     invertor.setAttribute('media', 'none');
     localStorage.setItem("theme", 'none');
   }
  invertor.textContent = invertor.textContent.trim();
  });

  contrast_mob.addEventListener('click', (e) => {
   let pressed = e.target.getAttribute('aria-pressed') === 'true';
   e.target.setAttribute('aria-pressed', String(!pressed));
   if(!pressed) {
     invertor.setAttribute('media', 'screen');
     localStorage.setItem("theme", 'screen');
   } else {
     invertor.setAttribute('media', 'none');
     localStorage.setItem("theme", 'none');
   }
  invertor.textContent = invertor.textContent.trim();
  });

  var savedTheme = localStorage.getItem("theme");
   if (savedTheme) {
     invertor.setAttribute("media", savedTheme);
     if (savedTheme == "screen") {
     //  checkbox.checked = true;
       contrast.setAttribute('aria-pressed', 'true');
     } else {
       //checkbox.checked = false;
       contrast.setAttribute('aria-pressed', 'false');
     }
  }

$(".login-remember").html('<p><input name="rememberme" class="filled-in" type="checkbox" id="rememberme" value="foreover" /><label for="rememberme">Remember Me</label></p>');

function printFunction() {
		window.print();
}



const btns = document.querySelectorAll('button[id^=btn]')

btns.forEach(btn => {

   btn.addEventListener('click', event => {
     var btnId = event.target.id;
     var lastChar = btnId[btnId.length -1];
        //instance.open(lastChar + 1)

        var id = parseInt(lastChar) + 1;
        var scrollelmnt = document.getElementById('section-'+ id );
scrollelmnt.classList.add("active");
     scrollelmnt.scrollIntoView({behavior: "smooth"});
   });

});

(function() {
  var elements;
  var windowHeight;

  function init() {
    elements = document.querySelectorAll('.wrapper');
    windowHeight = window.innerHeight;
  }

  function checkPosition() {
    for (var i = 0; i < elements.length; i++) {
      var element = elements[i];
      var positionFromTop = elements[i].getBoundingClientRect().top;

      if (positionFromTop - windowHeight <= -300) {
        element.classList.add('active');
      }
    }
  }

  window.addEventListener('scroll', checkPosition);
  window.addEventListener('resize', init);

  init();
  checkPosition();
})();
