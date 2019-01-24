<?php
// Comment Layout
function joints_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(''); ?>>
		<div class="media-object">
			<div class="btn-flat grey lighten-4">
        <header class="comment-author">

          <?php
          $comment_author = get_comment_author_link();

          printf('Suggested by <strong>%s</strong> on', $comment_author) ?>
          <time class="hide-on-med-and-down" datetime="<?php echo comment_time('Y-m-j'); ?>"><?php comment_time(__(' F jS, Y', 'jointswp')); ?></time>
          <time class="hide-on-large-only" datetime="<?php echo comment_time('Y-m-j'); ?>"><?php comment_time(__(' d-m-y', 'jointswp')); ?> </time>
          <?php //edit_comment_link(__('(Edit)', 'jointswp'),'  ','') ?>
          <?php
          $status = get_field('status', $comment);
          if( $status ) :

            echo '<span class="status yellow">
            ' . $status . '
            </span>';
          //  print_R($status);



             endif; ?>
        </header>
			  </div>
        <!-- <span class="badge waves-effect waves-light hide-on-small-only">
          <?php comment_reply_link(array_merge( $args, array('reply_text' => 'Reply', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></a>
        </span> -->

			<div class="media-object-section">
				<article id="comment-<?php comment_ID(); ?>" class="col s12">

					<?php if ($comment->comment_approved == '0') : ?>
						<div class="alert alert-info">
							<p><?php _e('Your suggestion has been sent to our team.', 'jointswp') ?></p>
						</div>
					<?php endif; ?>
					<section class="comment_content clearfix">
						<?php comment_text() ?>
            <span class="hide-on-med-and-up">
              <?php comment_reply_link(array_merge( $args, array('reply_text' => '<i class="mdi mdi-reply-all"></i> Reply ', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></a>
            </span>

					</section>


				</article>
			</div>
		</div>
	<!-- </li> is added by WordPress automatically -->
<?php
}

function ocn_disable_comment_url($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','ocn_disable_comment_url');
