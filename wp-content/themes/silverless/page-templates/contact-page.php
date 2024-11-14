<?php

/**
 * ============== Template Name: Contact Page
 *
 * @package silverless
 */

get_header();

$page_layout = get_field('page_layout');

$sidebar_content = false;

?>

<div class="page-layout page-layout__<?php echo $page_layout; ?>">

  <?php

  if (have_rows('flex_content')):
    while (have_rows('flex_content')):
      the_row();
      $row_layout = get_row_layout();
      get_template_part('template-parts/' . str_replace('_', '-', $row_layout));
    endwhile;
  endif;

  // Handle possible missing "Sidebar - End" flex component
  if ($sidebar_content) {
    echo '</div>';
  }

  ?>

</div>

<?php get_footer(); ?>