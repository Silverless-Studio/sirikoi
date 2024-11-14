<?php

$post = get_sub_field('post');
$space_size = get_sub_field('space_size');

global $sidebar_content;

?>

<div class="sidebar__related-post">
  <?php
  if ($post) {
    setup_postdata($post);
    if (have_rows('card')) {
      while (have_rows('card')) {
        the_row();
        get_template_part('/template-parts/card-image-vertical', null, array('show_read_more' => true));
      }
    }
    wp_reset_postdata();
  }
  ?>
</div>