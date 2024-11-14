<?php

$taxonomy_name = strtolower(get_sub_field('taxonomy'));
$terms = false;

$terms = get_terms(
  array(
    'taxonomy' => $taxonomy_name,
    'hide_empty' => false,
  )
);

?>

<div class="sidebar__filter">
  <input type="hidden" name="taxonomy" value="<?php echo $taxonomy_name; ?>" />
  <?php if ($terms && count($terms) > 0) { ?>
    <ul>
      <?php foreach ($terms as $term) { ?>
        <li>
          <label class="heading heading__md font__color__primary font__transform__uppercase">
            <input type="checkbox" name="term" value="<?php echo $term->slug; ?>" />
            <span>
              <?php echo $term->name; ?>
            </span>
          </label>
        </li>
      <?php } ?>
    </ul>
  <?php } ?>
</div>