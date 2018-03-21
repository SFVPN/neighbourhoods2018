<?php

acf_form(array(
  'post_id'		=> 'new_post',
  'post_content' => false,
  'post_title' => true,
  'new_post'		=> array(
    'post_type'		=> 'audits',
    'post_status'		=> 'draft'),
  'return'		=> home_url(),
  'fields' => array('field_59f8aa752b9b9', 'field_59f8afc020642', 'field_59f8aff63c8e4', 'field_5aaa97f9057dd', 'field_59f8a8282855c'),
  'submit_value'		=> __("Submit", 'acf'),
));
?>



<script defer type="text/javascript">


  var getUrlParameter = function getUrlParameter(sParam) {
   var sPageURL = decodeURIComponent(window.location.search.substring(1)),
  		 sURLVariables = sPageURL.split('&'),
  		 sParameterName,
  		 i;

   for (i = 0; i < sURLVariables.length; i++) {
  		 sParameterName = sURLVariables[i].split('=');

  		 if (sParameterName[0] === sParam) {
  				 return sParameterName[1] === undefined ? true : sParameterName[1];
  		 }
   }
  };

  var placename = getUrlParameter('placename');
  var placeaddress = getUrlParameter('placeaddress');
  var placeRef = getUrlParameter('ID');


    if (typeof(acf) != 'undefined') {
      // add an action for all datepicker fields
      acf.add_action('date_picker_init', function($input, args, $field) {
        // get the field key for this field

        // see if it's the start date field

          // add action to start date field datepicker  $input.datepicker().on('input change select', function(e) {
            // get the selected date
            var date = new Date();
            // add 5 days to date

            // set end date
            jQuery('[name="acf[field_59f8aa752b9b9][field_59f8af2e6b8de]"]').next().datepicker('setDate', date);


      });
    }

acf.add_action('load', function( $el ){
  $("#acf-_post_title").val(placename);
  $("#acf-field_5aaa97f9057dd").val(placeRef);
  $(".search").val(placename + ' ' + placeaddress);
  $(".-search").trigger('click');
  $("#acf-_post_title").focus();
  $(".entry-content").prepend("<div class='yellow center' style='padding: 1em;'><i class='material-icons left'>info</i>This is an audit for " + placename + ". Please check all of the details are correct before submitting</div>");
  $("textarea").each(function(){
if($(this).val() === "") {
	$(this).attr("placeholder", "Please add a description of " + placename + " here");
}
});
});





//$(".search").attr("placeholder", placename + placeaddress);


</script>
