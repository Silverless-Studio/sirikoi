<?php

$show_title = get_sub_field('show_title');
$title = get_sub_field('title');
$title_size = get_sub_field('title_size');
$title_align = get_sub_field('title_align');
$show_text_content = get_sub_field('show_text_content');
$width = get_sub_field('width');
$columns = get_sub_field('columns');
$read_more = get_sub_field('read_more');
$content = isset($read_more['content']) ? $read_more['content'] : '';
$enable_read_more = isset($read_more['enable_read_more']) ? $read_more['enable_read_more'] : false;
$read_more_content = isset($read_more['read_more_content']) ? $read_more['read_more_content'] : '';

$space_size = get_sub_field('space_size');

$grid_col = (12 - $width) / 2 + 1;

global $sidebar_content;

?>

<section
  class="container section-text-block spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">

  <div class="row">

    <?php get_template_part('template-parts/additional-artwork'); ?>

    <?php if ($show_title) { ?>

      <h2 class="heading heading__<?php echo $title_size; ?> font__color__primary"
        style="--title-align: <?php echo $title_align; ?>">
        <?php echo $title; ?>
      </h2>

    <?php } ?>

    <?php if ($show_text_content) { ?>

      <div class="grid grid__12">

        <div class="body columns__<?php echo $columns; ?> read-more-block" style="--grid-col: <?php echo $grid_col; ?>;">

          <?php echo $content; ?>

          <?php if ($enable_read_more && $read_more_content) { ?>

            <div class="read-more-content">

              <?php echo $read_more_content; ?>

            </div>

            <button class="button js-read-more-button heading heading__sm">READ MORE</button>

          <?php } ?>

        </div>

      </div>

    <?php } ?>

  </div>

</section>