<?php

$menu_name = get_sub_field('menu_name');

?>

<nav class="sidebar__navigation">
  <?php
  if ($menu_name) {
    $arrow = file_get_contents(locate_template('/inc/img/arrow.php'));
    wp_nav_menu(
      [
        'menu' => $menu_name,
        'menu_class' => 'sidebar__navigation__list heading heading__lg',
        'link_after' => $arrow
      ]
    );
  }
  ?>
</nav>