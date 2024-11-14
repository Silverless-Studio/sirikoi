<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package silverless
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="stylesheet" href="https://use.typekit.net/qpv8jkv.css">
    <?php wp_head(); ?>
</head>

<?php

$background_image = get_field('background_image', 'options');
$background_image_opacity = get_field('background_image_opacity', 'options');

$style = "";
if ($background_image) {
    $style = "--background-image: url(" . $background_image['url'] . "); --background-image-opacity: " . $background_image_opacity . ";";
}

$logo = get_field('logo', 'options');

?>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site" style="<?php echo $style; ?>">
        <a class="skip-link screen-reader-text" href="#primary">
            <?php esc_html_e('Skip to content', 'silverless'); ?>
        </a>

        <header id="masthead" class="site-header container">
            <div class="row grid grid__12 grid__non-responsive">
                <div class="site-branding">
                    <a href="<?php echo site_url(); ?>" title="<?php the_field('header_title', 'options'); ?>">
                        <img src="<?php echo $logo['sizes']['medium']; ?>" alt="<?php echo $logo['alt']; ?>" />
                    </a>
                </div>
                <div class="mobile-burger">
                    <?php get_template_part('inc/img/burger'); ?>
                </div>
            </div>
            <div class="row__extended offscreen-menu container">
                <div class="row">
                    <div class="offscreen-menu__content">
                        <div class="offscreen-menu__header">
                            <div class="logo">

                            </div>
                            <div class="menu-close">
                                <?php get_template_part('inc/img/cross'); ?>
                            </div>
                        </div>
                        <nav class="main-navigation">
                            <?php
                            wp_nav_menu(
                                [
                                    'theme_location' => 'main-menu',
                                    'menu_id' => 'main-navigation',
                                    'menu_class' => 'main-navigation-list heading heading__md',
                                    'items_wrap' => '<ul id="%1$s" data-visible="false" class="%2$s">%3$s</ul>',
                                ]
                            );
                            ?>
                        </nav>
                    </div>
                    <div class="offcanvas-menu--pre">
                        <div class="menu-close-sub">
                            <?php get_template_part('inc/img/arrow'); ?>
                        </div>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'pre-menu',
                                'container_class' => 'menu-items-sub'
                            )
                        );
                        ?>

                    </div>

                    <div class="offcanvas-menu--pre-prep">
                        <div class="menu-close-sub">
                            <?php get_template_part('inc/img/arrow'); ?>
                        </div>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'prep-menu',
                                'container_class' => 'menu-items-sub'
                            )
                        );
                        ?>
                    </div>

                    <div class="offcanvas-menu--contact">
                        <div class="menu-close-sub">
                            <?php get_template_part('inc/img/arrow'); ?>
                        </div>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'contact-menu',
                                'container_class' => 'menu-items-sub'
                            )
                        );
                        ?>
                    </div>

                    <div class="offcanvas-menu--about">
                        <div class="menu-close-sub">
                            <?php get_template_part('inc/img/arrow'); ?>
                        </div>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'about-menu',
                                'container_class' => 'menu-items-sub'
                            )
                        );
                        ?>
                    </div>

                </div>
            </div>
        </header>