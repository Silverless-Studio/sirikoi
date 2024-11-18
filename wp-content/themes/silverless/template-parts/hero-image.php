<?php

$hero_type = get_sub_field('hero_type');
$hero_size = get_sub_field('hero_size');

$enable_overlay = acf_get_sub_group_field('overlay', 'enable_overlay');
$overlay_colour = acf_get_sub_group_field('overlay', 'overlay_colour');
$overlay_opacity = acf_get_sub_group_field('overlay', 'overlay_opacity');

$hero_button = acf_get_sub_group_field('hero_footer', 'hero_button');
$show_breadcrumbs = acf_get_sub_group_field('hero_footer', 'show_breadcrumbs');

$space_size = get_sub_field('space_size');

global $sidebar_content;
global $video_modals;

?>

<section
    class="container hero hero__<?php echo $hero_size; ?> spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
    <div class="hero__background">

        <?php

                $title = get_sub_field('title');
                $subtitle = get_sub_field('subtitle');

                ?>

        <?php if ($hero_type == 'image') { ?>

        <?php

                    $background_image_anchor_x = get_sub_field('background_image_anchor_x');
                    $background_image_anchor_y = get_sub_field('background_image_anchor_y');
                    $hero_image = get_sub_field('background_image');
                    $src = wp_get_attachment_image_url($hero_image['ID'], 'full');
                    $srcset = wp_get_attachment_image_srcset($hero_image['ID'], 'full');
                    $sizes = wp_get_attachment_image_sizes($hero_image['ID'], 'full');

                    ?>

        <img src="<?php echo esc_attr($src); ?>" srcset="<?php echo esc_attr($srcset); ?>"
            sizes="<?php echo esc_attr($sizes); ?>" alt="<?php echo esc_attr($hero_image['title']); ?>"
            style="--anchor-x: <?php echo $background_image_anchor_x; ?>; --anchor-y: <?php echo $background_image_anchor_y; ?>;" />

        <?php } ?>

        <?php if ($hero_type == 'video') { ?>

        <?php

                    $background_video = get_sub_field('background_video');
                    $full_video = get_sub_field('full_video');
                    $play_full_video_text = get_sub_field('play_full_video_text');

                    $video_id = 1;

                    if ($full_video) {
                        $video_modals[$full_video['ID']] = $full_video['url'];
                    }

                    ?>

        <video autoplay loop muted playsinline>
            <source src="<?php echo $background_video['url']; ?>">
            </source>
        </video>

        <?php } ?>

    </div>
    <div class="row hero__<?php echo $hero_type; ?> hero__wrapper">

        <?php get_template_part('template-parts/additional-artwork'); ?>

        <?php if ($hero_type == 'image' || $hero_type == 'video') { ?>



        <?php if ($enable_overlay) { ?>

        <div class="hero__overlay"
            style="--overlay-color: <?php echo $overlay_colour; ?>; --overlay-opacity: <?php echo $overlay_opacity; ?>;">
        </div>

        <?php } ?>

        <div class="hero__content grid grid__12">

            <div class="hero__heading grid grid__2">

                <h1 class="heading heading__xxl font__color__white">
                    <?php echo $title; ?>
                </h1>

                <?php if ($subtitle) { ?>
                <h2 class="heading heading__md font__color__white">
                    <?php echo $subtitle; ?>
                </h2>
                <?php } ?>

                <?php if ($hero_type == 'video' && $full_video) { ?>
                <div class="play-container" data-video-id="<?php echo $full_video['ID']; ?>">
                    <?php get_template_part('inc/img/video-play'); ?>
                    <p><?php echo $play_full_video_text; ?></p>
                </div>
                <?php } ?>

            </div>

        </div>

        <div class="hero__navigation hero__navigation__down js_scroll-next-section">
            <?php echo get_template_part('/inc/img/chevron'); ?>
        </div>

        <?php } ?>

        <?php if ($hero_type == 'slider' && have_rows('slider_content')) { ?>

        <?php while (have_rows('slider_content')) { ?>

        <?php

                the_row();
                $background_image_anchor_x = get_sub_field('background_image_anchor_x');
                $background_image_anchor_y = get_sub_field('background_image_anchor_y');
                $hero_image = get_sub_field('background_image');
                $src = wp_get_attachment_image_url($hero_image['ID'], 'full');
                $srcset = wp_get_attachment_image_srcset($hero_image['ID'], 'full');
                $sizes = wp_get_attachment_image_sizes($hero_image['ID'], 'full');

                $title = get_sub_field('title');
                $subtitle = get_sub_field('subtitle');

                ?>

        <div class="hero__slide">

            <div class="hero__background">

                <img src="<?php echo esc_attr($src); ?>" srcset="<?php echo esc_attr($srcset); ?>"
                    sizes="<?php echo esc_attr($sizes); ?>" alt="<?php echo esc_attr($hero_image['title']); ?>"
                    style="--anchor-x: <?php echo $background_image_anchor_x; ?>; --anchor-y: <?php echo $background_image_anchor_y; ?>;" />

            </div>

            <?php if ($enable_overlay) { ?>

            <div class="hero__overlay"
                style="--overlay-color: <?php echo $overlay_colour; ?>; --overlay-opacity: <?php echo $overlay_opacity; ?>;">
            </div>

            <?php } ?>

            <div class="hero__content row grid grid__12">

                <div class="hero__heading">

                    <h1 class="heading heading__xxl font__color__white">
                        <?php echo $title; ?>
                    </h1>

                    <?php if ($subtitle) { ?>
                    <h2 class="heading heading__md font__color__white">
                        <?php echo $subtitle; ?>
                    </h2>
                    <?php } ?>

                </div>

            </div>

            <div class="hero__navigation hero__navigation__previous">
                <?php echo get_template_part('/inc/img/chevron'); ?>
            </div>

            <div class="hero__navigation hero__navigation__down js_scroll-next-section">
                <?php echo get_template_part('/inc/img/chevron'); ?>
            </div>

            <div class="hero__navigation hero__navigation__next">
                <?php echo get_template_part('/inc/img/chevron'); ?>
            </div>

        </div>

        <?php } ?>

        <?php } ?>

    </div>

    <div class="hero__footer row__extended">
        <div class="container">

          <div class="cta__title">
 <h2 class="heading heading__lg font__color__white">
                    <?php echo esc_html( get_field('hero_link_cta','options') ); ?>
                </h2>
          </div>
            <?php if ($hero_button) { ?>
            <div class="cta__button hero__button">
                <?php 
$link = get_field('hero_link','options');
if( $link ): 
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
    ?>
    <a class="button button__alt" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
<?php endif; ?>
            </div>

            <?php } ?>
            </div>

    </div>

</section>
  <?php
        if ($show_breadcrumbs && function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<div class="breadcrumbs paragraph small">', '</div>');
        }
        ?>
