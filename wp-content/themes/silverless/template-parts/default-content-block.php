<?php

if (have_rows('content_block')):
  while (have_rows('content_block')):
    the_row();
    $row_layout = get_row_layout();
    get_template_part('template-parts/default-content-blocks/' . str_replace('_', '-', $row_layout));
  endwhile;
endif;