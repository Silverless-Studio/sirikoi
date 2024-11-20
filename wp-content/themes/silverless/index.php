<?php

get_header();

$page_layout = get_field('page_layout');

$sidebar_content = false;

$video_modals = [];

?>

<div class="page-layout page-layout__default">

	<?php

	if (have_rows('flex_content')):
		while (have_rows('flex_content')):
			the_row();
			$row_layout = get_row_layout();
			get_template_part('template-parts/' . str_replace('_', '-', $row_layout));
		endwhile;
	endif;

	?>

</div>

<?php foreach ($video_modals as $video_id => $video_url) { ?>
	<div class="hero-video-modal" data-video-id="<?php echo $video_id; ?>">
		<video controls>
			<source src="<?php echo $video_url; ?>">
			</source>
		</video>
		<div class="close">
			<?php get_template_part('inc/img/cross'); ?>
		</div>
	</div>
<?php } ?>

<?php get_footer(); ?>