<?php

$gallery = get_sub_field('gallery');
$columns = get_sub_field('columns');
$responsive = get_sub_field('responsive');
$style_images = get_sub_field('style_images');
$container_width = acf_get_subfield_or_default('container_width', 12, null, true);

$space_size = get_sub_field('space_size');

$random = rand();

global $sidebar_content;

$collapse = "";
if ($responsive) {
  $collapse = "image__grid__collapse";
}

?>

<section
  class="container section-image spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
  <?php if (count($gallery) > 0) { ?>
    <div class="image__grid row__<?php echo $container_width; ?> <?php echo $collapse; ?>">
      <div
        class="<?php echo $style_images ? "image__styled" : ""; ?> grid grid__<?php echo $columns; ?> <?php echo $responsive ? "" : "grid__non-responsive"; ?>">
        <?php foreach ($gallery as $index => $image) { ?>
          <a data-fslightbox="gallery-<?php echo $random; ?>" data-type="image" href="<?php echo esc_url($image['url']); ?>"
            data-caption="<?php echo esc_attr($image['caption']); ?>"
            class="fade-target <?php echo $index == 0 ? 'active' : ''; ?>">
            <img class="fade" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy" />
          </a>
        <?php } ?>
      </div>
      <div class="navigation">
        <div class="navigation__box navigation__previous">
          <?php echo get_template_part('/inc/img/arrow'); ?>
        </div>
        <div class="navigation__box navigation__next">
          <?php echo get_template_part('/inc/img/arrow'); ?>
        </div>
      </div>
    </div>
  <?php } ?>
</section>