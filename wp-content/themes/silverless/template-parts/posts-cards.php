<?php

$space_size = get_sub_field('space_size');

$post_type = get_sub_field('post_type');
$enable_pagination = get_sub_field('enable_pagination');
$number_of_posts = get_sub_field('number_of_posts');
$posts_per_line = get_sub_field('posts_per_line');

$post_count = 999;

$data_attr = "";
if ($enable_pagination) {
  $data_attr = 'data-pagination="' . $number_of_posts . '"';
} else {
  $post_count = $number_of_posts;
}

$show_read_more = get_sub_field('show_read_more');
$show_post_date = get_sub_field('show_post_date');

$exclude = [];

if ($post_type->name == $post->post_type) {
  $exclude[] = $post->ID;
}

$args = [
  'post_type' => $post_type->name,
  'posts_per_page' => $post_count,
  'orderby' => 'post_date',
  'order' => 'DESC',
  'post_status' => 'publish',
  'post__not_in' => $exclude
];

$query = new WP_Query($args);

$card_args = [
  'card_orientation' => 'vertical',
  'image_fit' => 'cover',
  'image_style' => 'default',
  'card_height' => 'default',
  'show_post_date' => true,
  'show_read_more' => true,
  'content_padding' => 'lg'
];

global $sidebar_content;

?>

<section
  class="container section-cards spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">

  <?php if ($query->have_posts()) { ?>

    <div class="row grid grid__<?php echo $posts_per_line; ?> card__posts" <?php echo $data_attr; ?>>

      <?php while ($query->have_posts()) { ?>

        <?php
        $query->the_post();
        $categories = get_the_category();
        $slugs = wp_list_pluck($categories, 'slug');
        $class_names = join(' ', $slugs);
        ?>

        <?php if (have_rows('card')) { ?>

          <?php while (have_rows('card')) { ?>

            <?php the_row(); ?>

            <div id="card-<?php the_ID(); ?>" class="mix <?php echo $class_names ? $class_names : ''; ?>">

              <?php get_template_part('/template-parts/card', null, $card_args); ?>

            </div>

          <?php } ?>

        <?php } ?>

      <?php } ?>

      <?php wp_reset_postdata(); ?>

    </div>

    <div class="row mixitup-page-list"></div>

  <?php } ?>

</section>