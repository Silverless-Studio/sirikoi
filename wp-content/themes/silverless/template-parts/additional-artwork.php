<?php

$post_id = null;

if (isset($args['post_id']) && $args['post_id']) {
  $post_id = $args['post_id'];
}


if (isset($args['from_group']) && $args['from_group']) {
  $enable_additional_artwork = acf_get_sub_group_field($args['from_group'], "enable_additional_artwork", $post_id);
  $additional_artwork = acf_get_sub_group_field($args['from_group'], "additional_artwork", $post_id);
  $left_alignment = acf_get_sub_group_field($args['from_group'], "left_alignment", $post_id);
  $bottom_alignment = acf_get_sub_group_field($args['from_group'], "bottom_alignment", $post_id);
  $x_translation = acf_get_sub_group_field($args['from_group'], "x_translation", $post_id);
  $y_translation = acf_get_sub_group_field($args['from_group'], "y_translation", $post_id);
  $rotation = acf_get_sub_group_field($args['from_group'], "rotation", $post_id);
  $opacity = acf_get_sub_group_field($args['from_group'], "opacity", $post_id);
  $scale = acf_get_sub_group_field($args['from_group'], "scale", $post_id);
} else {
  $field_prefix = "";

  if (isset($args['field_prefix'])) {
    $field_prefix = $args['field_prefix'] . "_";
  }

  $enable_additional_artwork = get_sub_field("{$field_prefix}enable_additional_artwork");
  $hide = get_sub_field("{$field_prefix}hide_on_mobile");
  $additional_artwork = get_sub_field("{$field_prefix}additional_artwork");
  $left_alignment = get_sub_field("{$field_prefix}left_alignment");
  $bottom_alignment = get_sub_field("{$field_prefix}bottom_alignment");
  $x_translation = get_sub_field("{$field_prefix}x_translation");
  $y_translation = get_sub_field("{$field_prefix}y_translation");
  $rotation = get_sub_field("{$field_prefix}rotation");
  $opacity = get_sub_field("{$field_prefix}opacity");
  $scale = get_sub_field("{$field_prefix}scale");
}

$style = "--left-alignment: " . $left_alignment . "%;";
$style .= "--bottom-alignment: " . $bottom_alignment . "%;";
$style .= "--x-translation: " . $x_translation . "%;";
$style .= "--y-translation: " . $y_translation . "%;";
$style .= "--rotation: " . $rotation . "deg;";
$style .= "--opacity: " . $opacity . ";";
$style .= "--scale: " . $scale . ";";

?>

<?php if ($enable_additional_artwork) { ?>

<div class="additional-artwork <?php if ($hide):
    echo 'hide-on-mobile';
  endif; ?>" style="<?php echo $style; ?>">
    <img src="<?php echo $additional_artwork['url']; ?>" alt="" />
</div>

<?php } ?>