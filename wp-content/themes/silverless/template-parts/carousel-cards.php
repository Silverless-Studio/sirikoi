<?php

$space_size = get_sub_field('space_size');

global $sidebar_content;

?>

<section
    class="container section-carousel spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
    <?php if (have_rows('carousel')) { ?>
        <div class="row">
            <div class="carousel__slider carousel__card">
                <?php while (have_rows('carousel')) { ?>
                    <?php
                    the_row();
                    ?>
                    <?php echo get_template_part('/template-parts/card-image-vertical'); ?>
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