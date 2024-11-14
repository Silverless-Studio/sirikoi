<?php

$space_size = get_sub_field('space_size');

$contact_email_address = get_field('contact_email_address', 'options');
$contact_address = get_field('contact_address', 'options');
$what_three_words = get_field('what_three_words', 'options');
$google_maps_link = get_field('google_maps_link', 'options');

global $sidebar_content;

$spacer = $space_size ? "spacer spacer__" . $space_size : "";
$sidebar = $sidebar_content ? "sidebar__content" : "";

$container_class = "container section-contact-details $spacer $sidebar";

?>

<section class="<?php echo $container_class; ?>">
  <div class="row grid grid__12 contact-details">
    <div class="col-offset__2 col-span__3 contact-details__details paragraph small">

      <h2 class="heading heading__lg">Contact Us</h2>
      <?php if (have_rows('contact_phone_numbers', 'option')) { ?>
        <div>
          <?php while (have_rows('contact_phone_numbers', 'option')) { ?>
            <?php
            the_row();
            $contact_phone_number = get_sub_field('contact_phone_number');
            ?>
            <a href="tel://<?php echo $contact_phone_number; ?>">
              <?php echo $contact_phone_number; ?>
            </a>
          <?php } ?>
        </div>
      <?php } ?>
      <?php if ($contact_email_address) { ?>
        <a href="mailto://<?php echo $contact_email_address; ?>">
          <?php echo $contact_email_address; ?>
        </a>
      <?php } ?>
      <?php if ($contact_address) { ?>
        <p class="small">
          <?php echo $contact_address; ?>
        </p>
      <?php } ?>
      <?php if ($what_three_words || $google_maps_link) { ?>
        <div>
          <?php if ($what_three_words) { ?>
            <a href="<?php echo $what_three_words['url']; ?>" target="<?php echo $what_three_words['target']; ?>">
              <?php echo $what_three_words['title']; ?>
            </a>
          <?php } ?>
          <?php if ($google_maps_link) { ?>
            <a href="<?php echo $google_maps_link['url']; ?>" target="<?php echo $google_maps_link['target']; ?>">
              <?php echo $google_maps_link['title']; ?>
            </a>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
    <div class="col-span__8 contact-details__map">
      <?php get_template_part('template-parts/map'); ?>
    </div>
  </div>
</section>