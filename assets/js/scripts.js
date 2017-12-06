
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


  //  var markers = document.querySelectorAll('input[type="radio"]'),
  //      l = markers.length,
  //      i, txt;
  //  for (i = l - 1; i >= 0; i--) {
  //      txt = markers[i].nextSibling;
  //      $(txt).prev().attr('id', 'r' + markers[i].value);
  //      $(txt).wrap('<label for="r' + markers[i].value + '"/>');
  //  };

  //  var markers = document.querySelectorAll('input[type="checkbox"]'),
  //      l = markers.length,
  //      i, txt;
  //  for (i = l - 1; i >= 0; i--) {
  //      txt = markers[i].nextSibling;
  //      $(txt).prev().attr('id', 'r' + markers[i].value);
  //      $(txt).wrap('<label for="r' + markers[i].value + '"/>');
  //  };


   $('body').on('click','a[href^="#"]',function(event){
       event.preventDefault();
       var target_offset = $(this.hash).offset() ? $(this.hash).offset().top : 0;
       //change this number to create the additional off set
       var customoffset = $("header").height();
       $('html, body').animate({scrollTop:target_offset - customoffset}, 900);
   });

   $("#acf-_post_title").attr("placeholder","Please add a title for your submission. Just click on this text and start writing - it will disappear!");



 });




 var checkbox = document.getElementById('themer');
var invertor = document.getElementById('inverter');

var savedTheme = localStorage.getItem("theme");
  if (savedTheme) {
    invertor.setAttribute("media", savedTheme);
    if (savedTheme == "screen") {
      checkbox.checked = true;
    } else {
      checkbox.checked = false;
    }
}

checkbox.addEventListener('change', function () {


  // Triggers repaint in most browsers:
  invertor.setAttribute('media', this.checked ? 'screen' : 'none');
  localStorage.setItem("theme", this.checked ? 'screen' : 'none');
  // Forces repaint in Chrome:
  invertor.textContent = invertor.textContent.trim();
});


function switchStyles() {

   }

   var styleSwitcher = document.getElementById("styleSwitcher");
   if (styleSwitcher) {
     addEvent(styleSwitcher, "change", switchStyles);
   }



   function switchText() {
     var selectedOption = document.querySelector('input[name="text"]:checked').value; //this.options[this.selectedIndex],
       if (selectedOption) {

     document.getElementsByTagName("body")[0].setAttribute("id", "body-"+selectedOption);

     localStorage.setItem("bodyIdName", selectedOption);
   }
   }

   var textSwitcher = document.getElementById("textSwitcher");
     if (textSwitcher) {
   addEvent(textSwitcher, "change", switchText);
}
   var storedIdName = localStorage.getItem("bodyIdName");
   if (storedIdName) {
     var bodyIdRadio = document.getElementById("r"+storedIdName);
     if (bodyIdRadio) {
       bodyIdRadio.checked = true;
     }
     document.getElementsByTagName("body")[0].setAttribute("id", "body-"+storedIdName);
   }
