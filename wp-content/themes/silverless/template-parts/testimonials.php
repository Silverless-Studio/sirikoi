<?php

$testimonial_image = get_sub_field('testimonial_image');
$space_size = get_sub_field('space_size');

global $sidebar_content;

?>

<section
  class="container section-testimonials spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
  <?php if (have_rows('testimonials')) { ?>
    <div class="row__10 testimonials">
      <img src="/wp-content/themes/silverless/inc/img/stars.png" alt="" class="testimonials__stars__outside" />
      <div class="testimonials__wrapper">
        <img src="/wp-content/themes/silverless/inc/img/stars.png" alt="" class="testimonials__stars__inside" />
        <div class="grid grid__10">
          <div class="testimonials__image col-span__2">
            <img src="<?php echo $testimonial_image['sizes']['medium']; ?>"
              alt="<?php echo $testimonial_image['alt']; ?>" />
          </div>
          <div class="col-span__7">
            <div class="navigation">
              <div class="navigation__box navigation__previous">
                <?php echo get_template_part('/inc/img/arrow'); ?>
              </div>
              <div class="navigation__box navigation__next">
                <?php echo get_template_part('/inc/img/arrow'); ?>
              </div>
            </div>
            <div class="testimonials__slider">
              <?php while (have_rows('testimonials')) { ?>
                <?php
                the_row();
                $testimonial = get_sub_field('testimonial');
                $author = get_sub_field('author');
                ?>
                <div class="testimonials__content">

                  <div
                    class="testimonials__testimonial font__color__tertiary font__style__italic font__weight__light heading heading__lg">
                    <?php echo $testimonial; ?>
                  </div>
                  <p class="testimonials__author font__color__primary small">
                    <?php echo $author; ?>
                  </p>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
</section>