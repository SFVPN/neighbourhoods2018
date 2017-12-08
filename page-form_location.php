<?php
/*
Template Name: Form - Location
*/

acf_form_head();

get_header();


global $current_user;
get_currentuserinfo();
$url = get_permalink();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<main  id="maincontent" class="row container">


	<section class="row" itemscope itemtype="http://schema.org/WebPage">


			<header class="resources-article-header col s12 center">


				<h1 class="page-title"><?php the_title(); ?></h1>


				<? //var_dump($post);?>
			</header> <!-- end article header -->


				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


<div class="entry-content col s12">
	<div class="fixed-action-btn">
     <a class="btn-floating btn-large modal-trigger red" href="#modal1">
       <i class="large material-icons">info</i>
     </a>
   </div>
<div id="modal1" class="modal">
	<div class="modal-content">
	<div class="acf-fields -top -border"><div class="acf-field acf-field-message acf-field-59f8ad432b1fe" data-type="message" data-key="field_59f8ad432b1fe">
<div class="acf-label">
<label for="acf-field_59f8ac0e3075f-field_59f8ad432b1fe">Before you start</label>			</div>
<div class="acf-input">
<p>We have a flexible system for submitted content to the website so you can choose just the information that is relevant to the data you are uploading. Although you have the option of adding multiple images/documents etc in a single submission, you may feel that a report or presentation (for example) should be submitted individually from other documents you are adding. If this is the case, simply fill in the relevant details for the document being added and then click <strong>Publish/Submit</strong>, before creating any other submissions you deem necessary.</p>
		</div>
</div>
<div class="acf-field acf-field-message acf-field-59f8ad8de020e" data-type="message" data-key="field_59f8ad8de020e">
<div class="acf-label">
<label for="acf-field_59f8ac0e3075f-field_59f8ad8de020e">Basic instructions</label>			</div>
<div class="acf-input">
<p>Firstly, you must fill in the <strong>Title</strong> and then the <strong>Submissions Details</strong> box: with the date, name of the user(s) submitting the content and the category of content.</p>
		</div>
</div>
</div>
</div>
	 <div class="modal-footer">
		 <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
	 </div>
 </div>

		<?php

		get_template_part( 'parts/form', 'location' );


		endwhile; endif;
		?>




		    <?php // get_sidebar(); ?>

</div>

	</section>
</main> <!-- end main -->


<?php get_footer(); ?>
