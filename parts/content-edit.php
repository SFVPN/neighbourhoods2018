<div data-target="modal1" class="fixed-action-btn modal-trigger">
	 <a class="btn-floating btn-large teal">
		 <i class="large material-icons">mode_edit</i>
	 </a>
 </div>

 <!-- Modal Structure -->
 <div id="modal1" class="modal bottom-sheet modal-fixed-footer">
	 <div class="modal-content">
		 <h4 class="light center blue-grey darken-4 white-text">Edit <?php the_title();?></h4>
		 <?php acf_form(array(
			 'submit_value' => __("Update Content", 'acf'),
			 'html_submit_button'	=> '<input type="submit" class="acf-button green button button-primary button-large" value="%s" />',
		 )); ?>
	 </div>
	 <div class="modal-footer">
		 <button id="close-modal" class="modal-action modal-close waves-effect waves-green btn grey darken-4 white-text">Close</button>
	 </div>
 </div>
