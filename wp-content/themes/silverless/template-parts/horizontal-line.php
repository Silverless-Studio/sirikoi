<?php

$space_size = get_sub_field('space_size');

global $sidebar_content;

?>

<section
  class="container section-horizontal-line spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
  <div class="row">
    <hr />
  </div>
</section>