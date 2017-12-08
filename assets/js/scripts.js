
/*
These functions make sure WordPress
and Materialize play nice together.
*/

// Remove empty P tags created by WP inside of Accordion and Orbit
jQuery(document).ready(function() {
  //  jQuery('.accordion p:empty, .orbit p:empty').remove();

  $('.button-collapse').sideNav({
    menuWidth: 300, // Default is 300
    edge: 'left', // Choose the horizontal origin
    closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
    draggable: true // Choose whether you can drag to open on touch screens
  }
);


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


var options = [
    {selector: '#About', offset: 0, callback: 'Materialize.fadeInImage("#About")' },
    {selector: '#Teaching', offset: 0, callback: 'Materialize.fadeInImage("#Teaching")' },
    {selector: '#Classes', offset: 0, callback: 'Materialize.fadeInImage("#Classes")' }
];
Materialize.scrollFire(options);


window.cookieconsent_options = {
       learnMore: 'More info',
       theme: 'dark-bottom',
       link: document.location.origin + '/privacy'
   };


   $('body').on('click','a[href^="#"]',function(event){
      // event.preventDefault();
       var target_offset = $(this.hash).offset() ? $(this.hash).offset().top : 0;
       //change this number to create the additional off set
       var customoffset = $("header").height();
       $('html, body').animate({scrollTop:target_offset - customoffset}, 900);
   });

   $("#acf-_post_title").attr("placeholder","Please add a title for your submission. Just click on this text and start writing - it will disappear!");

 });


 //var checkbox = document.getElementById('themer');
 var contrast = document.getElementById('themeContrast');
var invertor = document.getElementById('inverter');


const toggle = document.querySelector('[aria-pressed]');

toggle.addEventListener('click', (e) => {
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



$('#plustext').on('click', function () {
    $('body, p').animate({'font-size': '+=5'});
});

$('#minustext').on('click', function () {
    $('body, p').animate({'font-size': '-=5'});
});
