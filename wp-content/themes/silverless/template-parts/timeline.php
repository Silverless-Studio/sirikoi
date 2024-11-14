<?php

$space_size = get_sub_field('space_size');

global $sidebar_content;

?>


<section
  class="container section-timeline spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
  <div class="row grid grid__12">
    <div class="timeline-wrapper">
      <?php $timeline = get_sub_field('dates');
      if (have_rows('dates')):
        $count = 0; ?>
        <?php while (have_rows('dates')):
          the_row();
          $count++;
          $is_last = $count === count($timeline);
          ?>
          <div class="timeline-event">
            <div class="timeline-event__timeline <?php if ($is_last)
              echo 'last'; ?>">
              <div class="dot">
                <?php get_template_part('inc/img/dot'); ?>
              </div>
            </div>
            <div class="timeline-event__details">
              <div class="label">
                <span class="label__date heading heading__lg font__color__tertiary">
                  <?php the_sub_field('date'); ?>
                </span>
                <span class="label__heading heading heading__lg font__color__primary">
                  <?php the_sub_field('heading'); ?>
                </span>
                <?php echo get_template_part('/inc/img/arrow'); ?>
              </div>
              <div class="content">
                <?php $image = get_sub_field('image'); ?>
                <?php if ($image) { ?>
                  <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
                <?php } ?>
                <div class="timeline-desc body">
                  <?php the_sub_field('text_content'); ?>

                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</section>