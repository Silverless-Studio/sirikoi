<?php

$gallery = get_sub_field('gallery');
$show_captions = get_sub_field('show_captions');
$space_size = get_sub_field('space_size');
$random = rand();

global $sidebar_content;

?>

<section
  class="container section-carousel spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content__extended" : ""; ?>">
  <?php if (have_rows('gallery')) { ?>
    <div class="row__extended carousel__slider carousel__images">
      <?php while (have_rows('gallery')) { ?>
        <?php
        the_row();
        $image = get_sub_field('image');
        $title = get_sub_field('title');
        $link = get_sub_field('link');
        ?>
        <div>
          <div class="fade-target carousel__image">
            <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"
              loading="lazy" class="fade" />
            <?php if ($title) { ?>
              <div class="title">
                <p class="heading heading__xxl">
                  <?php echo $title; ?>
                </p>
              </div>
            <?php } ?>
            <?php if ($link) { ?>
              <div class="carousel__button">
                <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="button">
                  <?php echo $link['title']; ?>
                </a>
              </div>

            <?php } ?>
            <?php if ($show_captions && $image['caption']) { ?>
              <p class="caption heading heading__xs">
                <?php echo $image['caption']; ?>
              </p>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="navigation row">
      <div class="navigation__box navigation__previous">
        <?php echo get_template_part('/inc/img/arrow'); ?>
      </div>
      <div class="navigation__box navigation__next">
        <?php echo get_template_part('/inc/img/arrow'); ?>
      </div>
    </div>
  <?php } ?>
</section>