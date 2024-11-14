<?php

$space_size = get_sub_field('space_size');
global $sidebar_content;
$post_id = get_the_ID();

?>

<section
    class="container section-tabbed-content spacer spacer__<?php echo $space_size; ?> <?php echo $sidebar_content ? "sidebar__content" : ""; ?>">
    <div class="row__11 row-start__3 grid grid__10 tabbed-content additional-artwork-container">
        <div class="col-span__4">
            <div class="tabbed-content__tabs">
                <?php get_template_part('template-parts/additional-artwork', null, ['field_prefix' => 'tabs_additional_artwork']); ?>
                <?php if (have_rows('tabs')) { ?>
                  <?php while (have_rows('tabs')) { ?>
                    <?php
                    the_row();
                    $index = get_row_index();
                    $title = get_sub_field('title');
                    $tab_class = "tabbed-content__tab";
                    if ($index == 1) {
                      $tab_class .= " active";
                    }
                    ?>
                    <div class="<?php echo $tab_class; ?>" data-tab="<?php echo $index; ?>">
                        <h3 class="heading heading__lg">
                            <?php echo $title; ?>
                        </h3>
                        <?php echo get_template_part('/inc/img/arrow'); ?>
                    </div>
                  <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="tabbed-content__content-container col-span__6">
            <?php if (have_rows('tabs')) { ?>
              <?php while (have_rows('tabs')) { ?>
                <?php
                the_row();
                $index = get_row_index();
                $content_title = get_sub_field('content_title');
                $content = get_sub_field('content');
                ?>
                <div class="tabbed-content__content" data-tab="<?php echo $index; ?>">
                    <?php if ($content_title) { ?>
                      <h4 class="heading heading__xl heading__underline font__color__primary">
                          <?php echo $content_title; ?>
                      </h4>
                    <?php } ?>

                    <?php if (get_sub_field('type_of_content') == 'text') {
                      echo $content;
                    } elseif (get_sub_field('type_of_content') == 'embed') {

                      echo '<div class="embed-content">';
                      $related_pages = get_sub_field('page_content', $current_page_id);

                      if ($related_pages) {
                        foreach ($related_pages as $related_page) {

                          if (have_rows('flex_content', $related_page)):
                            while (have_rows('flex_content', $related_page)):
                              the_row();
                              $row_layout = get_row_layout();
                              get_template_part('template-parts/' . str_replace('_', '-', $row_layout));
                            endwhile;
                          endif;
                        }
                      }
                      echo '</div>';
                    } ?>
                </div>
              <?php } ?>
            <?php } ?>
            <?php get_template_part('template-parts/additional-artwork', null, ['field_prefix' => 'content']); ?>
        </div>
    </div>
</section>