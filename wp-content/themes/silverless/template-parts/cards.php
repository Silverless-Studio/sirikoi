<?php

$space_size = get_sub_field('space_size');
$container_width = acf_get_subfield_or_default('container_width', 12, null, true);
$cards_per_line = acf_get_subfield_or_default('cards_per_line', 12, null, true);

$card_orientation = get_sub_field('card_orientation');
$image_position = get_sub_field('image_position');
$content_padding = get_sub_field('content_padding');
$sticky_image = get_sub_field('sticky_image');
$image_width = acf_get_subfield_or_default('image_width', 8, null, true);
$image_style = get_sub_field('image_style');
$image_fit = get_sub_field('image_fit');
$card_height = get_sub_field('card_height');
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');

if ($card_orientation == 'horizontal') {
    $cards_per_line = 1;
}

$card_args = [
    'card_orientation' => $card_orientation,
    'image_position' => $image_position,
    'image_fit' => $image_fit,
    'sticky_image' => $sticky_image,
    'image_width' => $image_width,
    'image_style' => $image_style,
    'card_height' => $card_height,
    'card_width' => $container_width,
    'title' => $title,
    'subtitle' => $subtitle,
    'content_padding' => $content_padding
];

global $sidebar_content;

?>

<section
    class="container section-cards <?php echo $space_size ? "spacer spacer__" . $space_size : ""; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
    <div
        class="row__<?php echo $container_width; ?> grid grid__<?php echo $cards_per_line; ?> additional-artwork-container">
        <?php get_template_part('template-parts/additional-artwork'); ?>
        <?php if (have_rows('cards')) { ?>
            <?php while (have_rows('cards')) { ?>
                <?php the_row(); ?>
                <?php get_template_part('/template-parts/card', null, $card_args); ?>
            <?php } ?>
        <?php } ?>
    </div>
</section>