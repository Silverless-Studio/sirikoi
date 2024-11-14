<?php

$form_shortcode = get_sub_field('form_shortcode');
$style_form_container = get_sub_field('style_form_container');
$container_width = get_sub_field('container_width');
$override_container_offset = get_sub_field('override_container_offset');
$container_offset = get_sub_field('container_offset');

$space_size = get_sub_field('space_size');

$style = "";
if ($override_container_offset) {
  $style = "--container-offset: " . $container_offset . ";";
}


global $sidebar_content;

?>


<section
  class="container section-form spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
  <div class="row__<?php echo $container_width; ?>" style="<?php echo $style; ?>">
    <?php if ($style_form_container) { ?>
      <div class="testimonials">
        <img src="/wp-content/themes/silverless/inc/img/stars.png" alt="" class="testimonials__stars__outside" />
        <div class="testimonials__wrapper">
          <img src="/wp-content/themes/silverless/inc/img/stars.png" alt="" class="testimonials__stars__inside" />
          <div class="grid grid__10">
            <div class="row__10">
              <?php echo do_shortcode($form_shortcode); ?>
            </div>
          </div>
        </div>
      </div>
    <?php } else { ?>
      <?php get_template_part('template-parts/additional-artwork'); ?>
      <?php echo do_shortcode($form_shortcode); ?>
    <?php } ?>
  </div>
</section>