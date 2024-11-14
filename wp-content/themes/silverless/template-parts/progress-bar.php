<?php

$title = get_sub_field('title');
$text_content = get_sub_field('text_content');
$button = get_sub_field('button');
$minimum_value = acf_get_subfield_or_default('minimum_value', 0, null, true);
$maximum_value = acf_get_subfield_or_default('maximum_value', 1, null, true);
$current_value = acf_get_subfield_or_default('current_value', 0, null, true);
$container_width = get_sub_field('container_width');
$space_size = get_sub_field('space_size');

$bar_progress = (($current_value - $minimum_value) / $maximum_value) * 100;

global $sidebar_content;

?>


<section
  class="container section-progress-bar spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
  <div class="progress row__<?php echo $container_width; ?> grid grid__<?php echo $container_width; ?>">
    <?php if ($title) { ?>
      <h2 class="progress__heading heading heading__xl font__color__primary col-span__6">
        <?php echo $title; ?>
      </h2>
    <?php } ?>
    <div class="progress__bar-container col-span__<?php echo $container_width; ?>">
      <div class="progress__bar" style="--progress: <?php echo $bar_progress; ?>%;">
      </div>
      <?php if (have_rows('progress_labels')) { ?>
        <div class="progress__labels">
          <?php while (have_rows('progress_labels')) { ?>
            <?php
            the_row();
            $progress = get_sub_field('progress_%');
            $label = get_sub_field('label');
            ?>
            <div class="heading heading__sm font__color__primary" style="--progress: <?php echo $progress; ?>%;">
              <?php echo $label; ?>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
    <?php if ($text_content || $button) { ?>
      <div class="progress__footer col-span__6">
        <?php if ($text_content) { ?>
          <?php echo $text_content; ?>
        <?php } ?>
        <?php if ($button) { ?>
          <a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>" class="button">
            <?php echo $button['title']; ?>
          </a>
        <?php } ?>
      <?php } ?>
    </div>
</section>