
<div class="col s12 yellow center" style="padding: 1em;">
  You need to be log in using the form below to submit an audit.
</div>

<?php

$permalink = get_permalink();
$args = array(
'redirect' => site_url( $_SERVER['REQUEST_URI'] ),
'id_username' => 'user',
'id_password' => 'pass',
)
;

wp_login_form( $args );
echo '<div class="row center"><div class="col s4">' . do_shortcode('[nextend_social_login provider="google"]') . '</div><div class="col s4">' . do_shortcode('[nextend_social_login provider="twitter"]') . '</div><div class="col s4">' . do_shortcode('[nextend_social_login provider="facebook"]') . '</div></div>';

?>

<?php echo site_url( $_SERVER['REQUEST_URI'] ); ?>
