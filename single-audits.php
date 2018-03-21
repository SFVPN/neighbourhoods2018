<?php
acf_form_head();

get_header(); ?>
<main id="maincontent" class="row">

		<?php if (have_posts()) : while (have_posts()) : the_post();



 get_template_part( 'parts/loop', 'single-audits' );


		endwhile; endif;

		?>


</main> <!-- end main -->

<script type="text/javascript">
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

var place = getUrlParameter('place');
var placeRef = getUrlParameter('ID');
</script>
<?php get_footer(); ?>
