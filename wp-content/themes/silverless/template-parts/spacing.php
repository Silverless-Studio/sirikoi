<?php

$space_size = get_sub_field('space_size');

global $sidebar_content;

?>

<section class="container section-spacer <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
  <div class="row">
    <div class="spacer__<?php echo $space_size; ?>"></div>
  </div>
</section>