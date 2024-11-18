<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package silverless
 */

get_header();

$background_image = get_field('404_hero_background_image', 'options');
$enable_overlay = get_field('404_hero_enable_overlay', 'options');
$overlay_colour = get_field('404_hero_overlay_colour', 'options');
$overlay_opacity = get_field('404_hero_overlay_opacity', 'options');

?>

<section class="container hero">
	<img src="<?php echo $background_image['url']; ?>" alt="<?php echo $background_image['alt']; ?>" />
	<div class="hero__overlay"
					style="--overlay-color:#000000; --overlay-opacity: 0.3;">
				</div>
	<div class="row__extended">
		<div class="container hero__posts__title">
			
			<h1 class="row heading heading__xxl font__color__white">
				404 Error
			</h1>
			<div class="row">
				<a href="<?php echo home_url(); ?>" class="button__404">
					<div class="button__arrow">
						<?php echo get_template_part('/inc/img/arrow'); ?>
					</div>
					<div class="button__text">
						<span class="heading heading__sm">
							Return
						</span>
					</div>
					
				</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>