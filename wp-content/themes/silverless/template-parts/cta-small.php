<?php

$image = get_sub_field('image');
$title = get_sub_field('title');
$button_link = get_sub_field('button_link');
$space_size = get_sub_field('space_size');

global $sidebar_content;

?>

<section
  class="container section-cta spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
  <div class="row cta cta__wrapper fade-target">
    <div class="cta__image">
      <img class="fade" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
    </div>
    <div class="cta__content">
      <div class="grid grid__2">
        <h2 class="heading heading__xl">
          <?php echo $title; ?>
        </h2>
        <a href="<?php echo $button_link['url']; ?>" target="<?php echo $button_link['target']; ?>"
          class="button button__primary">
          <span class="heading heading__sm">
            <?php echo $button_link['title']; ?>
          </span>
          <div class="button__arrow">
            <?php echo get_template_part('/inc/img/arrow'); ?>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>