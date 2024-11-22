<?php

$image = get_sub_field('image');
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$button_link = get_sub_field('button_link');
$space_size = get_sub_field('space_size');

global $sidebar_content;

?>

<section
    class="container section-cta spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
    <div class="row cta cta__wrapper cta__large fade-target">
        <div class="background-fade"></div>
        <div class="cta__image">
            <img class="fade" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
        </div>
        <div class="cta__content">
            <?php if ($subtitle) { ?>
                <h3 class="heading heading__xs">
                    <?php echo $subtitle; ?>
                </h3>
            <?php } ?>
            <h2 class="heading heading__underline font__color__white heading__xl">
                <?php echo $title; ?>
            </h2>
            <?php if ($button_link) { ?>
                <a href="<?php echo $button_link['url']; ?>" target="<?php echo $button_link['target']; ?>" class="button">
                    <?php echo $button_link['title']; ?>
                </a>
            <?php } ?>
        </div>
    </div>
</section>