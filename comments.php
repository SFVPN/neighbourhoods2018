<?php
	if ( post_password_required() ) {
		return;
	}
?>

<div id="suggestion-trigger" class="col s12 grey lighten-2 center no-print">
<p>
	Do you have any suggestions to improve this resource?
</p>
<button data-target="suggestion" class="btn red waves-effect waves-light modal-trigger">Send us your thoughts</button>
</div>
	<!-- Modal Structure -->
   <div id="suggestion" class="modal bottom-sheet no-print">
     <div class="modal-content">
			 <a href="#" class="modal-close waves-effect waves-light btn-flat grey lighten-2">Close</a>

       	<?php comment_form(array('class_submit'=>'btn', 'title_reply' => __( '<h5>How can we improve this resource?</h5>' ), 'label_submit'      => __( 'Post Your Suggestion' ), 'cancel_reply_before' => __( '<span class="waves-effect waves-light">' ), 'cancel_reply_after' => __( '</span>' ), 'comment_field' => '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . _x( 'Leave Your Suggestion Here', 'noun' ) . '</label><textarea id="comment" placeholder="Leave Your Suggestion Here..." class="textarea" name="comment" cols="45" rows="4" aria-required="true"></textarea></p>',  'comment_notes_before' => '<p class="gdpr-notice yellow comment-notes"><span class="block title">Privacy Notice</span>' .
    __( 'You do not need to include your email address to submit a suggestion. However, if you do, OCN may contact you regarding this submission. We will not use your email for any other purposes.' ) . ( $req ? $required_text : '' ) .
    '</p>',)); ?>
     </div>



   </div>

	<?php // You can start editing here ?>

	<?php if ( have_comments() ) : ?>
<div id="comments" class="comments-area row no-print">
		<h2 class="comments-title h6 center">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'Tracked changes - &ldquo;%2$s&rdquo;', 'Tracked changes - &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'jointswp' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'jointswp' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Suggestions', 'jointswp' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Suggestions', 'jointswp' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<div class="commentlist col s12">
			<?php wp_list_comments('type=comment&callback=joints_comments'); ?>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'jointswp' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Suggestions', 'jointswp' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Suggestions', 'jointswp' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>
	</div>
	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	//	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<!-- <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'jointswp' ); ?></p> -->
	<?php //endif; ?>




</div><!-- #comments -->
<?php if(is_user_logged_in()){?>
	<script type="text/javascript">
	  jQuery('document').ready(function($){
	    // Get the comment form
	    var commentform=$('#commentform');
			var insert=$('#comment');
	    // Add a Comment Status message
	    commentform.prepend('<div id="comment-status" ></div>');
	    // Defining the Status message element
	    var statusdiv=$('#comment-status');
	    commentform.submit(function(){
	      // Serialize and store form data
	      var formdata=commentform.serialize();
	      //Add a status message
	      statusdiv.html('<div class="progress"><div class="indeterminate"></div></div>');
	      //Extract action URL from commentform
	      var formurl=commentform.attr('action');
	      //Post Form with data
	      $.ajax({
	        type: 'post',
	        url: formurl,
	        data: formdata,
	        error: function(XMLHttpRequest, textStatus, errorThrown){
	          statusdiv.html('<p class="ajax-error" role="alert" >You might have left one of the fields blank, or be posting too quickly</p>');
	        },
	        success: function(data, textStatus){
	        //  if(data=="success")
	            statusdiv.html('<p class="green lighten-3 black-text col s6 ajax-success" role="alert">Thanks for your response. You can now close this page</p>');
	        //  else
	          //  statusdiv.html('<p class="ajax-error" >Please wait a while before posting your next comment</p>');
	          commentform.find('textarea[name=comment]').val('');
	        }
	      });
	      return false;
	    });
	  });
	</script>
<?php } else {?>
<script type="text/javascript">
  jQuery('document').ready(function($){
    // Get the comment form
    var commentform=$('#commentform');
		var insert=$('#comment');
    // Add a Comment Status message
    commentform.prepend('<div id="comment-status" ></div>');
    // Defining the Status message element
    var statusdiv=$('#comment-status');
    commentform.submit(function(){
      // Serialize and store form data
      var formdata=commentform.serialize();
      //Add a status message
      statusdiv.html('<div class="progress"><div class="indeterminate"></div></div>');
      //Extract action URL from commentform
      var formurl=commentform.attr('action');
      //Post Form with data
      $.ajax({
        type: 'post',
        url: formurl,
        data: formdata,
        error: function(XMLHttpRequest, textStatus, errorThrown){
          statusdiv.html('<p class="ajax-error" role="alert">You might have left one of the fields blank, or be posting too quickly</p>');
        },
        success: function(data, textStatus){
        //  if(data=="success")
            statusdiv.html('<p class="green lighten-3 black-text col s6 ajax-success" role="alert">Thanks for your response. It has been passed to our team for approval. You can now close this page</p>');
        //  else
          //  statusdiv.html('<p class="ajax-error" >Please wait a while before posting your next comment</p>');
          commentform.find('textarea[name=comment]').val('');
        }
      });
      return false;
    });
  });
</script>
<?php } ?>
