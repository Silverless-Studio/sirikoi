<?php

$sidebar_width = acf_get_subfield_or_default('sidebar_width', 3, null, true);
$sidebar_offset = acf_get_subfield_or_default('sidebar_offset', 1, null, true);
$content_width = acf_get_subfield_or_default('content_width', 6, null, true);
$content_offset = acf_get_subfield_or_default('content_offset', 0, null, true);

global $sidebar_content;
$sidebar_content = true;

$style = "--sidebar-width: {$sidebar_width}; --sidebar-offset: {$sidebar_offset}; --content-width: {$content_width}; --content-offset: {$content_offset};"

  ?>

<div class="container sidebar__container" style="<?php echo $style; ?>">

  <aside class="spacer__md">

    <?php
    if (have_rows('sidebar')):
      while (have_rows('sidebar')):
        the_row();
        $row_layout = get_row_layout();
        get_template_part('template-parts/' . str_replace('_', '-', $row_layout));
      endwhile;
    endif;

    ?>

  </aside>