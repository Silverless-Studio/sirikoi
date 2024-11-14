<?php

$title = get_sub_field('title');
$text_content = get_sub_field('text_content');
$target = get_sub_field('target');
$space_size = get_sub_field('space_size');

global $sidebar_content;

?>


<section
  class="container section-countdown spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
  <div class="countdown row__10 grid grid__2">
    <img src="/wp-content/themes/silverless/inc/img/stars.png" alt="" class="countdown__stars__inside" />
    <div class="countdown__info">
      <?php if ($title) { ?>
        <h2 class="progress__heading heading heading__xl heading__underline font__color__primary">
          <?php echo $title; ?>
        </h2>
        <?php if ($text_content) { ?>
          <?php echo $text_content; ?>
        <?php } ?>
      <?php } ?>
    </div>
    <div class="countdown__display" data-target="<?php echo $target; ?>">
      <div class="countdown__display__card countdown__display__days">
        <span class="value heading heading__xl"></span>
        <span class="descriptor heading heading__md">Days</span>
      </div>
      <div class="countdown__display__card countdown__display__hours">
        <span class="value heading heading__xl"></span>
        <span class="descriptor heading heading__md">Hours</span>
      </div>
      <div class="countdown__display__card countdown__display__minutes">
        <span class="value heading heading__xl"></span>
        <span class="descriptor heading heading__md">Minutes</span>
      </div>
    </div>
  </div>
</section>