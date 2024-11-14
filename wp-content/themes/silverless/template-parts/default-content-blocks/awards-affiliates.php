<?php

$title = acf_get_sub_group_field('awards_affiliates', 'title', 'options');
$title_size = acf_get_sub_group_field('awards_affiliates', 'title_size', 'options');
$title_align = acf_get_sub_group_field('awards_affiliates', 'title_align', 'options');

$gallery = acf_get_sub_group_field('awards_affiliates', 'gallery', 'options');
$columns = acf_get_sub_group_field('awards_affiliates', 'columns', 'options');
$container_width = acf_get_sub_group_field('awards_affiliates', 'container_width', 'options');

$space_size = acf_get_sub_group_field('awards_affiliates', 'space_size', 'options');

$random = rand();

global $sidebar_content;

?>

<section
  class="section-default-content__awards-affiliates container spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">

  <?php if (count($gallery) > 0) { ?>

    <div class="row additional-artwork-container">

      <?php get_template_part('template-parts/additional-artwork', null, ['from_group' => 'awards_affiliates', 'post_id' => 'options']); ?>

      <h2 class="heading heading__<?php echo $title_size; ?> font__color__primary"
        style="--title-align: <?php echo $title_align; ?>">
        <?php echo $title; ?>
      </h2>

    </div>

    <div class="row__<?php echo $container_width; ?>">
      <div class="grid grid__<?php echo $columns; ?> grid__non-responsive">
        <?php foreach ($gallery as $index => $image) { ?>
          <a data-fslightbox="gallery-<?php echo $random; ?>" data-type="image" href="<?php echo esc_url($image['url']); ?>"
            data-caption="<?php echo esc_attr($image['caption']); ?>"
            class="fade-target <?php echo $index == 0 ? 'active' : ''; ?>">
            <img class="fade" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" loading="lazy" />
          </a>
        <?php } ?>
      </div>
    </div>
  <?php } ?>

</section>