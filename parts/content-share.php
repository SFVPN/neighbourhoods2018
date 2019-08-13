


<div id="share-links" class="center-align">
  <a class="chip" href="https://twitter.com/intent/tweet?url=<?php echo get_permalink(); ?>&text=<?php the_title(); ?>" aria-label="Share this content on Twitter">Share on Twitter <i aria-hidden="true" class="mdi mdi-twitter"></i></a>

	<a class="chip" href="mailto:?subject=I wanted to share this post with you from <?php bloginfo('name'); ?>&body=<?php the_title('','',true); ?>&#32;&#32;<?php echo wp_get_shortlink() ?>" aria-label="Email this content to a friend or colleague">Share by email <i aria-hidden="true" class="mdi mdi-email"></i></a>

  <a class="chip" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo wp_get_shortlink() ?>" aria-label="Share this content on Facebook">Share on Facebook <i aria-hidden="true" class="mdi mdi-facebook"></i></a>
</div>
