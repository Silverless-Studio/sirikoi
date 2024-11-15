<?php

$space_size = get_sub_field('space_size');

global $sidebar_content;

?>

<section
  class="container section-accordion spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?> <?php echo esc_html ( get_sub_field('background_colour') ); ?>">
  <div class="row__10">
    <?php if (have_rows('records')) { ?>
      <div class="accordion">
        <?php while (have_rows('records')) { ?>
          <?php
          the_row();
          $title = get_sub_field('title');
          $content = get_sub_field('content');
          ?>
          <div class="accordion__record">
            <div class="accordion__heading">
              <h3 class=" heading heading__lg ">
                <?php echo $title; ?>
              </h3>
              <?php echo get_template_part('/inc/img/arrow'); ?>
            </div>
            <div class="accordion__content">
              <?php echo $content; ?>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
</section>