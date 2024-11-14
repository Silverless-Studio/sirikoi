<?php

$space_size = get_sub_field('space_size');
$images = get_sub_field('gallery') ?: array();
$image_count = count($images);
$random = rand();

global $sidebar_content;

?>

<section
  class="container section-image-gallery row spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
  <?php if ($image_count > 0) { ?>
    <div class="row grid grid__6 image-gallery image-gallery__tessellated">
      <?php foreach ($images as $i => $image) { ?>
        <a data-fslightbox="gallery-<?php echo $random; ?>" data-type="image" href="<?php echo esc_url($image['url']); ?>"
          data-caption="<?php echo esc_attr($image['caption']); ?>" class="fade-target image-gallery__image">
          <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
            loading="lazy" class="fade <?php echo $i > 7 ? "additional" : ""; ?>" />
        </a>
      <?php } ?>
    </div>
    <?php if ($image_count > 8) { ?>
      <button class="button load-more js-load-more">Load More</button>
    <?php } ?>
  <?php } ?>
</section>