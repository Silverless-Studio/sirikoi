<?php

$background_colour = get_sub_field('colour');
$padding = get_sub_field('padding_space_size');
$space_size = get_sub_field('space_size');

$qwe = get_fields();

global $sidebar_content;

?>

<div
  class="background__color background__color__<?php echo $background_colour; ?> padding__<?php echo $padding; ?> spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">