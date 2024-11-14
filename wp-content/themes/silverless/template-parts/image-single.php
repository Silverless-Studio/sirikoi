<?php

$image = get_sub_field('image');
$size = get_sub_field('size');
$apply_border = get_sub_field('apply_border');
$fade_image = get_sub_field('fade_image');
$blend_mode = get_sub_field('blend_mode');
$space_size = get_sub_field('space_size');

$class = "image image__single fade-target image__" . $size;

if ($apply_border) {
  $class .= " image__bordered";
}

global $sidebar_content;

?>

<section
  class="container section-image spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
  <div class="row grid grid__12">
    <div class="<?php echo $class; ?>">
      <img class="<?php echo $fade_image ? "fade" : ""; ?>" src="<?php echo $image['url']; ?>"
        alt="<?php echo $image['alt']; ?>" style="--blend-mode: <?php echo $blend_mode; ?>;" />
    </div>
  </div>
</section>