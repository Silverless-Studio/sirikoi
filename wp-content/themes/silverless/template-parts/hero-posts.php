<?php

$post_type = get_sub_field('post_type');

$space_size = get_sub_field('space_size');

global $sidebar_content;

$args = [
  'posts_per_page' => 1,
  'orderby' => 'post_date',
  'order' => 'DESC',
  'post_type' => $post_type->name,
  'post_status' => 'publish'
];

$query = new WP_Query($args);
?>

<?php if ($query->have_posts()) { ?>
  <?php while ($query->have_posts()) { ?>
    <?php $query->the_post();
    $qwe = get_fields();
    ?>
    <section
      class="container hero hero__posts spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
      <div class="row">
        <?php get_template_part('template-parts/additional-artwork', null, ['field_prefix' => 'additional_artwork_1']); ?>
        <?php get_template_part('template-parts/additional-artwork', null, ['field_prefix' => 'additional_artwork_2']); ?>
        <div class="card card__horizontal card__image__default grid grid__12 card__layout__left">
          <?php if (have_rows('card')) { ?>
            <?php while (have_rows('card')) { ?>
              <?php
              the_row();
              $image = get_sub_field('image');
              $title = get_sub_field('title');
              $text_content = get_sub_field('text_content');
              ?>
              <div class="card__image card__image__cover col-span__8">
                <img class="fade" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
              </div>
              <div class="card__content col-span__4">
                <div class="card__content__info">
                  <?php if ($title) { ?>
                    <h2 class="heading heading__xl heading__underline font__color__primary">
                      <?php echo $title; ?>
                    </h2>
                  <?php } ?>
                  <?php echo $text_content; ?>
                </div>
                <div class="card__content__actions">
                  <a href="<?php echo the_permalink(); ?>" class="button">
                    Find out more
                  </a>
                </div>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
      <div class="hero__footer">

        <?php
        if (!is_front_page() && function_exists('yoast_breadcrumb')) {
          yoast_breadcrumb('<div class="breadcrumbs paragraph small">', '</div>');
        }
        ?>

      </div>
    </section>
    <?php wp_reset_postdata(); ?>
  <?php } ?>
<?php } ?>