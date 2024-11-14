<?php

$video = get_sub_field('video');
$video_poster = get_sub_field('video_poster');
$space_size = get_sub_field('space_size');

global $sidebar_content;

?>

<section
    class="container section-video spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
    <div class="row grid grid__12">
        <div class="video-wrapper fade-target">
            <video class="fade" poster="<?php echo esc_attr($video_poster['url']); ?>">
                <source src="<?php echo esc_attr($video['url']); ?>"
                    type="<?php echo esc_attr($video['mime_type']); ?>">
            </video>
            <div class="play-button">
                <div class="play">
                    <?php echo get_template_part('/inc/img/video-play'); ?>
                    <h3 class="heading heading__sm">Play</h3>
                </div>
            </div>
        </div>
    </div>
</section>