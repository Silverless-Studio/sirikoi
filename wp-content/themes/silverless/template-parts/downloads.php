<?php

$space_size = get_sub_field('space_size');

global $sidebar_content;

?>

<section
  class="container section-downloads spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">

  <?php if (have_rows('files')) { ?>

    <div class="<?php echo $sidebar_content ? "row" : "row__6"; ?> downloads__container">

      <?php while (have_rows('files')) { ?>
        <?php
        the_row();
        $icon = get_sub_field('icon');
        $file = get_sub_field('file');
        $date = date_create($file['date']);
        ?>

        <a class="downloads__file" href="<?php echo $file['url']; ?>" download="<?php echo $file['filename']; ?>">

          <div class="downloads__icon">

            <img src="/wp-content/themes/silverless/inc/img/download.png" alt="" />

          </div>

          <div class="downloads__info">

            <p class="heading heading__lg font__color__primary">
              <?php echo $file['title']; ?>
            </p>

            <p class="heading heading__sm font__color__tertiary">
              <?php echo date_format($date, get_option('date_format')); ?>
            </p>

          </div>

        </a>

      <?php } ?>

    </div>

  <?php } ?>

</section>