<?php
/*********************
RESUABLE COMPONENTS
*********************/

function contact_card_OCN($fieldKey, $addressField) {

  $fields = acf_get_fields($fieldKey);

  if( $fields ):
    $group_phone = get_field('contact_landline');
    $formatted_phone = explode(" ", $group_phone);
    $formatted_phone = implode("-", $formatted_phone);
    $map_key = get_field('api_key', 'option');
    $addressArray = get_field_object($addressField);?>
    <div id="contact-box" class="grey lighten-5">
      <div class="contact-content">
       <span class="block contact-title">Contact</span>

          <?php foreach( $fields as $field ):
              $value = get_field( $field['name'] );

              if(!empty($value)):

                if($field['type'] == 'text') {?>

                  <span><strong><?php echo $field['label']; ?></strong> <?php echo $value; ?></span>

                <?php } elseif ($field['type'] == 'url') {
                  $group_website = $value;
                  ?>

                  <span><strong><?php echo $field['label']; ?></strong> <a href="<?php echo $value; ?>"><?php echo $value; ?></a></span>

                <?php } elseif ($field['type'] == 'email') {
                  $group_email = $value;
                  ?>

                  <span><strong><?php echo $field['label']; ?></strong> <a href="mailto:<?php echo $value; ?>"><?php echo $value; ?></a> </span>

                <?php } else {	}?>

              <?php endif;
            endforeach; ?>
                <span><strong><?php echo $addressArray['label']; ?></strong> <?php echo $addressArray['value']['address']; ?></span>

      </div>
      <img class="responsive-img" src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $addressArray['value']['lat'];?>,<?php echo $addressArray['value']['lng'];?>&zoom=16&size=640x385&maptype=terrain&format=png&visual_refresh=true
      &markers=color:0x01a89e%7Csize:mid%7C<?php echo $addressArray['value']['lat'];?>,<?php echo $addressArray['value']['lng'];?>&key=<?php echo $map_key;?>">
    </div>

    <script type="application/ld+json">
    { "@context" : "http://schema.org",
    	"@type" : "Organization",
     "name": "<?php the_title();?>",
     "address": {
    		"@type": "PostalAddress",
    		"addressLocality": "<?php echo $addressArray['value']['state'];?>, <?php echo $addressArray['value']['country'];?>",
    		"postalCode": "<?php echo $addressArray['value']['post_code'];?>",
    		"streetAddress": "<?php echo $addressArray['value']['street_name'];?>"
    	},
    	"email": "<?php echo $group_email;?>",
    	"url" : "<?php echo $group_website;?>",
    	"contactPoint" : [
    		{ "@type" : "ContactPoint",
    			"telephone" : "+44-<?php echo $formatted_phone;?>",
    			"contactType" : "office",
    			"areaServed" : "UK"
    		} ] }
    </script>
  <?php endif;
}


function activities_card_OCN() {

  $contact = get_field('activity_contact');
  $map_key = get_field('api_key', 'option');
  $addressArray = get_field_object('contact_address');?>

    <div id="contact-box" class="grey lighten-5">
      <div class="schedule-content">


       <?php 		if( have_rows('activity_schedule') ):

     					$frequency = get_field('activity_schedule_main');

     					echo '<div class="activity-schedule"><span class="activity-chip">Current schedule</span><br />' . $frequency['label'] . ' - ';
     				// loop through the rows of data
     					while ( have_rows('activity_schedule') ) : the_row();

     						$month_day = get_sub_field('activity_schedule_month_day');
     						$days = get_sub_field('activity_schedule_day');

     								if($month_day):
     								echo '<span>
     								' . $month_day['label'] . '
     								</span>';
     								endif;

     								if($days):
     									$terms = array();
     									foreach($days as $day) {
     										$terms[] = $day->name;
     									}
     									echo implode(', ', $terms);
     								endif;

     					endwhile;
     					echo '</div>';
     			else :

     					// no rows found

     			endif;?>

            <div class="address"><span class="activity-chip">Location</span><br /> <?php echo $addressArray['value']['address']; ?></div>

    <?php echo '<div id="contact">';
            if($contact):
            echo '<span class="contact-label activity-chip">Contact</span>';

      			foreach($contact as $person) {
              $contactFields = get_field_objects($person);
              //print_R($contactFields);
              if( $contactFields ): ?>
    <ul class="contact">
        <?php foreach( $contactFields as $field ):
          if(!empty($field['value'])):

            if($field['name'] == 'contact_name') {?>

              <li><?php echo $field['value']; ?></li>

            <?php } elseif ($field['type'] == 'text') {?>

              <li><strong><?php echo $field['label']; ?></strong> <?php echo $field['value']; ?></li>

            <?php } elseif ($field['type'] == 'url') {?>

              <li><strong><?php echo $field['label']; ?></strong> <a href="<?php echo $field['value']; ?>"><?php echo $field['value']; ?></a></li>

            <?php } elseif ($field['type'] == 'email') {

              ?>

              <li><strong><?php echo $field['label']; ?></strong> <a href="mailto:<?php echo $field['value']; ?>"><?php echo $field['value']; ?></a> </li>

            <?php } else {	}?>

          <?php
          ?>
        <?php endif;
      endforeach; ?>
    </ul>
<?php endif;
	}
endif;
echo '</div>';?>
      </div>
      <img class="responsive-img" src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $addressArray['value']['lat'];?>,<?php echo $addressArray['value']['lng'];?>&zoom=16&size=640x440&maptype=terrain&format=png&visual_refresh=true
      &markers=color:0x01a89e%7Csize:mid%7C<?php echo $addressArray['value']['lat'];?>,<?php echo $addressArray['value']['lng'];?>&key=<?php echo $map_key;?>">
    </div>
  <?php
}

function activities_archive_OCN() {

  $contact = get_field('activity_contact');

  $addressArray = get_field_object('contact_address');?>

        <?php echo '<p>' . get_field('introduction') . '</p>';?>

        <?php echo '<div class="contact-archive">';
                if($contact):
                echo '<span class="contact-label activity-chip">Contact</span>';

                foreach($contact as $person) {
                  $contactFields = get_field_objects($person);
                  //print_R($contactFields);
                  if( $contactFields ): ?>
        <ul>
            <?php foreach( $contactFields as $field ):
              if(!empty($field['value'])):

                if($field['name'] == 'contact_name') {?>

                  <li><?php echo $field['value']; ?></li>

                <?php } elseif ($field['name'] == 'contact_landline') {?>

                  <li><strong><?php echo $field['label']; ?></strong> <?php echo $field['value']; ?></li>

                <?php } elseif ($field['name'] == 'contact_mobile') {?>

                  <li><strong><?php echo $field['label']; ?></strong> <?php echo $field['value']; ?></li>

                <?php } elseif ($field['type'] == 'url') {?>

                  <li><strong><?php echo $field['label']; ?></strong> <a href="<?php echo $field['value']; ?>"><?php echo $field['value']; ?></a></li>

                <?php } elseif ($field['type'] == 'email') {

                  ?>

                  <li><strong><?php echo $field['label']; ?></strong> <a href="mailto:<?php echo $field['value']; ?>"><?php echo $field['value']; ?></a> </li>

                <?php } else {	}?>

              <?php
              ?>
            <?php endif;
          endforeach; ?>
        </ul>
    <?php endif;
      }
    endif;
    echo '</div>';?>

  <?php
}

function toc_OCN() {
  $show_toc = get_field('show_toc');
  if ($show_toc):
  	//check if the repeater field has rows of data
  	 if( have_rows('section') ):
  			// loop through the rows of data
  			 while ( have_rows('section') ) : the_row();
  					 // display a sub field 'value'
  					 if( have_rows('blocks') ):
  					    echo '<ul id="toc">
  					      <li class="block label black-text">' . __( 'What\'s on this page?', 'ocn' ) . '</li>';
  		 // loop through the rows of data
  								while ( have_rows('blocks') ) : the_row();

  										if( get_row_layout() == 'heading_block' ):

  											echo '<li><a class="toc-' . get_sub_field('heading_size') . '" href="#heading-' . get_row_index() . '">' . get_sub_field('heading') . '</a></li>';

  										endif;

  								endwhile;
  						echo '</ul>';

              else :
  								// no layouts found
  						endif;

  			 endwhile;

  	 else :
  			 // no rows found
  	 endif;

  endif;
}

function steps_image_OCN() {

  $step_image = get_sub_field('steps_image');
  $step_image_title = sanitize_title($step_image['title']);

  if($step_image) {

  if( have_rows('step') ):

    echo
    '<div class="steps_block blue lighten-5">
      <div class="col s12 l5">
        <figure class="card grey darken-4">
          <div class="image-wrapper">
            <img src="' . $step_image['url'] . '" alt="' . $step_image['alt'] . '"/>';

            while ( have_rows('step') ) : the_row();
              $leftPos = get_sub_field('left_pos');
              $topPos = get_sub_field('top_pos');

              if($leftPos) {
                $rowIndex = get_row_index();
                echo '<span class="block image-marker" style="position: absolute; top:' . $topPos . '%; left:' . $leftPos . '%" id="' . $step_image_title . '-marker' . $rowIndex . '"aria-describedby="' . $step_image_title . '-' . $rowIndex . '">' . $rowIndex .  '</span>';
              }

            endwhile;

      echo '</div>
            <figcaption class="white-text">
            <i class="material-icons left">info</i>' . $step_image['caption'] . '
            </figcaption>
          </figure>
        </div>
        <ol class="steps col s12 l7">';
        // loop through the rows of data
          while ( have_rows('step') ) : the_row();

            echo '<li id="' . $step_image_title . '-' . get_row_index() . '">' . get_sub_field('step_description') .  '</li>';

          endwhile;

          echo '</ol>';

          else :

      // no rows found

    endif; // end steps block

    }
}
