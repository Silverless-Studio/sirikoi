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
	<div class="row__extended">
		<div class="hero__wrapper hero__wrapper__small">
			<div class="hero__background">
				<img src="<?php echo $background_image['url']; ?>" alt="<?php echo $background_image['alt']; ?>" />
			</div>
			<?php if ($enable_overlay) { ?>
				<div class="hero__overlay"
					style="--overlay-color: <?php echo $overlay_colour; ?>; --overlay-opacity: <?php echo $overlay_opacity; ?>;">
				</div>
			<?php } ?>
			<div class="hero__navigation hero__navigation__down js_scroll-next-section">
				<?php echo get_template_part('/inc/img/chevron'); ?>
			</div>
		</div>
		<div class="container hero__posts__title">
			<h2 class="row heading heading__xs">
				Error 404
			</h2>
			<h1 class="row heading heading__xxl">
				OOPS! This doesn’t look right.
			</h1>
			<div class="row">
				<a href="<?php echo home_url(); ?>" class="button button__secondary button__404">
					<div class="button__text">
						<span class="heading heading__sm">
							CLICK HERE TO GET BACK SOMEWHERE FAMILIAR
						</span>
					</div>
					<div class="button__arrow">
						<?php echo get_template_part('/inc/img/arrow'); ?>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>