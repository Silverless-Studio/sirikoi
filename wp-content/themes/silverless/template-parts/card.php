<?php

$image = get_sub_field('image');
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$text_content = get_sub_field('text_content');
$button_link = get_sub_field('button_link');

$card_orientation = $args['card_orientation'];
$content_padding = "card__content__padding__" . $args['content_padding'];
$card_width = 1;
$image_width = 1;
$content_width = 1;
$image_position = "";
$sticky_image = "";
$image_style = "card__image__default";
$image_fit = "card__image__cover";
$card_height = "";

$title_settings = ['font_size' => 'xl', 'colour' => 'primary', 'underline' => true, 'italic' => false];
$subtitle_settings = ['font_size' => 'lg', 'colour' => 'tertiary', 'italic' => false];

if ($card_orientation == 'vertical') {
    $image_style = "card__image__" . $args['image_style'];
    $image_fit = "card__image__" . $args['image_fit'];
    ;

    if ($args['card_height'] == 'double') {
        $card_height = "card__vertical__tall";
    }

} else {
    $image_position = " card__layout__" . $args['image_position'];
    $card_width = $args['card_width'];
    $image_width = $args['image_width'];
    $content_width = $card_width - $image_width;
    $sticky_image = $args['sticky_image'] ? "card__image__sticky" : "";
}

if (isset($args['title']) && $args['title']) {
    $title_settings = $args['title'];
}

if (isset($args['subtitle']) && $args['subtitle']) {
    $subtitle_settings = $args['subtitle'];
}

$title_class = "heading heading__{$title_settings['font_size']} font__color__{$title_settings['colour']}";
if ($title_settings['underline'])
    $title_class .= " heading__underline";
if ($title_settings['italic'])
    $title_class .= " font__style__italic";

$subtitle_class = "heading heading__{$subtitle_settings['font_size']} font__color__{$subtitle_settings['colour']}";
if ($subtitle_settings['italic'])
    $subtitle_class .= " font__style__italic";


?>

<div
    class="card card__<?php echo $card_orientation; ?> <?php echo $card_height; ?> <?php echo $image_style; ?> grid grid__<?php echo $card_width; ?> <?php echo $image_position; ?>">
    <div
        class="card__image <?php echo $sticky_image; ?> <?php echo $image_fit; ?> col-span__<?php echo $image_width; ?>">
        <?php if ($image) { ?>
            <img class="fade" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
        <?php } ?>
    </div>
    <div class="card__content <?php echo $content_padding; ?> col-span__<?php echo $content_width; ?>">
        <div class="card__content__info">
            <?php if (isset($args['show_post_date']) && $args['show_post_date']) { ?>
                <div class="post-title">
                    <h3 class="heading heading__sm heading__sm__alt font__color__tertiary">
                        <?php echo get_the_date('d.m.y'); ?>
                    </h3>
                    <h2 class="heading heading__xl heading__underline font__color__primary">
                        <?php echo $title; ?>
                    </h2>
                </div>
            <?php } else { ?>
                <?php if ($title) { ?>
                    <h2 class="<?php echo $title_class; ?>">
                        <?php echo $title; ?>
                    </h2>
                <?php } ?>
                <?php if ($subtitle) { ?>
                    <h3 class="<?php echo $subtitle_class; ?>">
                        <?php echo $subtitle; ?>
                    </h3>
                <?php } ?>
            <?php } ?>
            <?php echo $text_content; ?>
        </div>
        <?php if ($button_link || isset($args['show_read_more']) && $args['show_read_more']) { ?>
            <div class="card__content__actions">
                <?php if ($button_link) { ?>
                    <a href="<?php echo $button_link['url']; ?>" target="<?php echo $button_link['target']; ?>" class="button">
                        <?php echo $button_link['title']; ?>
                    </a>
                <?php } ?>
                <?php if (isset($args['show_read_more']) && $args['show_read_more']) { ?>
                    <a href="<?php echo the_permalink(); ?>" class="button">
                        Read more
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>