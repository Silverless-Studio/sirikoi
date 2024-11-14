<?php

$primary_text = get_sub_field('primary_text');
$content = get_sub_field('content');
$enable_read_more = get_sub_field('enable_read_more');
$read_more_content = get_sub_field('read_more_content');
$show_testimonial = get_sub_field('show_testimonial');
$testimonial = get_sub_field('testimonial');
$testimonial_author = get_sub_field('testimonial_author');
$image = get_sub_field('image');

$space_size = get_sub_field('space_size');

global $sidebar_content;

?>

<section
  class="container section-leading-text spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
  <div class="row__10 grid grid__10 additional-artwork-container">
    <?php get_template_part('template-parts/additional-artwork'); ?>
    <?php if ($primary_text) { ?>
      <div class="col-span__6">
        <h2 class="heading heading__xl font__color__primary heading__underline">
          <?php echo $primary_text; ?>
        </h2>
      </div>
    <?php } ?>
    <div class="read-more-block col-span__6">
      <?php echo $content; ?>
      <?php if ($enable_read_more && $read_more_content) { ?>
        <div class="read-more-content">
          <?php echo $read_more_content; ?>
        </div>
        <button class="button js-read-more-button">READ MORE</button>
      <?php } ?>
    </div>
    <div class="col-span__4">
      <div class="sticky-content">
        <?php if ($show_testimonial) { ?>
          <div class="testimonial heading heading__lg">
            <?php echo $testimonial; ?>
            <p class="author heading heading__lg">
              <?php echo $testimonial_author; ?>
            </p>
          </div>
        <?php } ?>
        <?php if ($image) { ?>
          <div class="image">
            <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
              loading="lazy" />
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>