jQuery(document).ready(function () {
  jQuery('.user_vote').click(function (e) {
    e.preventDefault();
    post_id = jQuery(this).attr('data-post_id');
    resource_id = jQuery(this).attr('data-resource_id');
    nonce = jQuery(this).attr('data-nonce');
    jQuery(this).addClass('hide');
    jQuery(this).next().removeClass('hide').focus();
    jQuery(this).closest('.pilot').addClass('done');

    jQuery.ajax({
      type: 'post',
      dataType: 'json',
      url: myAjax.ajaxurl,
      data: {
        action: 'my_user_vote',
        post_id: post_id,
        nonce: nonce,
        resource_id: resource_id,
      },
      success: function (response) {
        if (response.type == 'success') {
          jQuery('#counter_label').html(response.vote_count);
          jQuery('#vote_counter').attr('value', response.vote_count);
        } else {
          alert('Your vote could not be added');
        }
      },
    });
  });

  jQuery('.remove_complete').click(function (e) {
    e.preventDefault();
    post_id = jQuery(this).attr('data-post_id');
    resource_id = jQuery(this).attr('data-resource_id');
    nonce = jQuery(this).attr('data-nonce');
    console.log(post_id + ' ' + resource_id);

    jQuery(this).addClass('hide');
    jQuery(this).prev().removeClass('hide').focus();

    jQuery(this).closest('.pilot').removeClass('done');

    jQuery.ajax({
      type: 'post',
      dataType: 'json',
      url: myAjax.ajaxurl,
      data: {
        action: 'remove_complete',
        post_id: post_id,
        nonce: nonce,
        resource_id: resource_id,
      },
      success: function (response) {
        if (response.type == 'success') {
          jQuery('#counter_label').html(response.vote_count);
          jQuery('#vote_counter').attr('value', response.vote_count);
        } else {
          alert('Your vote could not be added');
        }
      },
    });
  });
});
