<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package silverless
 */

?>

<?php

$logo = get_field('footer_logo', 'options');
$background_image = get_field('footer_background_image', 'options');
$contact_email_address = get_field('contact_email_address', 'options');
$contact_address = get_field('contact_address', 'options');
$contact_us_page = get_field('contact_us_page', 'options');
$register_page = get_field('register_page', 'options');
$google_maps_link = get_field('google_maps_link', 'options');
$mis_link = get_field('mis_link', 'options');

?>

<footer id="colophon" class="site-footer container font__color__white">
    <div class="row">
        <div class="footer__main">
            <div class="footer__image">
                <img src="<?php echo $background_image['sizes']['large']; ?>"
                    alt="<?php echo $background_image['alt']; ?>" />
            </div>
            <div class="grid grid__12">
                <div class="logo col-offset__2 col-span__3">
                    <a href="<?php echo site_url(); ?>" title="<?php the_field('header_title', 'options'); ?>">
                        <img src="<?php echo $logo['sizes']['medium']; ?>" alt="<?php echo $logo['alt']; ?>" />
                    </a>
                </div>
                <div class="nav col-span__3">
                    <h3 class="heading heading__lg">Quick Links</h3>
                    <nav class="footer-navigation">
                        <?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu',
								'menu_id' => 'footer-navigation',
								'menu_class' => 'small',
								'items_wrap' => '<ul id="%1$s" data-visible="false" class="%2$s">%3$s</ul>',

							)
						);
						?>
                    </nav>
                </div>
                <div class="contact-details col-span__3 paragraph small">
                    <h3 class="heading heading__lg">Contact Us</h3>
                    <?php if ($contact_us_page) { ?>
                    <a href="<?php echo $contact_us_page['url']; ?>" target="<?php echo $contact_us_page['target']; ?>">
                        <?php echo $contact_us_page['title']; ?>
                    </a>
                    <?php } ?>
                    <?php if ($register_page) { ?>
                    <a href="<?php echo $register_page['url']; ?>" target="<?php echo $register_page['target']; ?>">
                        <?php echo $register_page['title']; ?>
                    </a>
                    <?php } ?>
                    <?php if (have_rows('contact_phone_numbers', 'option')) { ?>
                    <?php while (have_rows('contact_phone_numbers', 'option')) { ?>
                    <?php
							the_row();
							$contact_phone_number = get_sub_field('contact_phone_number');
							?>
                    <a href="tel://<?php echo $contact_phone_number; ?>">
                        <i class="fa-solid fa-phone"></i>
                        <?php echo $contact_phone_number; ?>
                    </a>
                    <?php } ?>
                    <?php } ?>

                    <a href="mailto://<?php echo $contact_email_address; ?>">
                        <i class="fa-regular fa-envelope"></i>
                        <?php echo $contact_email_address; ?>
                    </a>
                    <p class="small">
                        <i class="fa-regular fa-map"></i>
                        <?php echo $contact_address; ?>
                    </p>
                    <?php if ($google_maps_link) { ?>
                    <a href="<?php echo $google_maps_link['url']; ?>"
                        target="<?php echo $google_maps_link['target']; ?>">
                        <i class="fa-solid fa-location-dot"></i>
                        <?php echo $google_maps_link['title']; ?>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="footer__dark">
            <div class="grid grid__12">
                <div class="socials col-offset__2 col-span__3">
                    <?php if (have_rows('socials', 'option')) { ?>
                    <?php while (have_rows('socials', 'option')) { ?>
                    <?php
							the_row();
							$icon = get_sub_field('icon');
							$url = get_sub_field('link');
							?>
                    <a href="<?php echo $url['url']; ?>">
                        <i class="fa-brands <?php echo $icon; ?>"></i>
                    </a>
                    <?php } ?>
                    <?php } ?>
                </div>
                <div class="copyright col-offset__5 col-span__6">
                    <p class="small">
                        <span>©
                            <?php echo date("Y"); ?> - All Rights Reserved
                        </span>
                        <span class="sep">&nbsp;|&nbsp;</span>
                        <span>Pembroke House School</span>
                    </p>
                </div>
                <div class="silverless col-span__2">
                    <a href="https://silverless.co.uk">
                        <?php get_template_part('inc/img/silverless-logo'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

</footer><!-- #colophon -->


</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>