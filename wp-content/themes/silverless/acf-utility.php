<?php
/**
 * Utility: ACF
 *
 * Helpers that act on ACF fields
 * https://gist.github.com/ithinkandicode/ce10af7555ba57634db98cd54e04c826
 */


/**
 * Get an ACF field value, or use a provided default value if the ACF field
 * was not set
 *
 * @example acf_get_field_or_default( 'fieldname', 'Placeholder text', $post_ID, true )
 * @example acf_get_field_or_default( 'fieldname', 'green', 'option' )
 *
 * @param   string  $fieldname             ACF field name
 * @param   null    $default               Default value, used if the checked value is not available
 * @param   mixed   $post_ID               Post ID or post object (or null to use the current post). Also accepts "option", or any other ACF field key (eg. term object for taxonomy term fields)
 * @param   bool    $use_default_if_false  True to return the default value if the checked value is false (by default, only returns the default value if the checked value is null, ie. not set)
 * @param   bool    $is_subfield           True to use get_sub_field, rather than the default get_field
 * @param   bool    $format_value          Whether to apply formatting logic (native ACF arg). Defaults to true
 *
 * @return  mixed                          Field value, or default
 */
function acf_get_field_or_default($fieldname, $default = null, $post_ID = null, $use_default_if_false = false, $is_subfield = false, $format_value = true)
{
  if ($is_subfield) {
    $field_value = get_sub_field($fieldname, $format_value);
  } else {
    $field_value = get_field($fieldname, $post_ID, $format_value);
  }

  if (is_null($field_value) || ($use_default_if_false && !$field_value)) {
    return $default;
  } else {
    return $field_value;
  }
}


/**
 * Wrapper for acf_get_field_or_default( ..., $is_subfield = true )
 *
 * @see acf_get_field_or_default
 */
function acf_get_subfield_or_default($fieldname, $default = null, $post_ID = null, $use_default_if_false = false, $format_value = true)
{
  return acf_get_field_or_default($fieldname, $default, $post_ID, $use_default_if_false, true, $format_value, );
}


function acf_row_is_first()
{
  // Not: get_row_index is not zero based, so 1 means the first row, etc
  return get_row_index() === 1;
}


function acf_row_is_last($field_name)
{
  return get_row_index() === acf_row_count($field_name);
}


function acf_row_is_odd()
{
  // Get remainder, if it's 0 then the number is safely divisible by 2 and
  // and therefore even and returns false
  return get_row_index() % 2;
}


// Note: Use outside of while(have_rows())
function acf_row_count($field_name, $is_sub_field = false)
{
  if ($is_sub_field) {
    $field = get_sub_field($field_name);
  } else {
    $field = get_field($field_name);
  }

  if (is_array($field)) {
    return count($field);
  } else {
    return 1;
  }
}


/**
 * Get an ACF group field value, with validation and an option for defaults
 *
 * Returns null if the group/field was not available and no default was set
 *
 * @example acf_get_group_field( 'mygroup', 'groupfield', 'option', 'HelloWorld' );
 *
 * @param   string  $groupname  ACF group name
 * @param   string  $fieldname  Field name within the group
 * @param   int     $post_ID    (Optional) Post ID. Defaults to null (ie. the global post)
 * @param   mixed   $default    (Optional) Default value. Defaults to null
 *
 * @return  mixed               The group field value. If the group field was not available, returns either null or the specified default
 */
function acf_get_group_field($groupname, $fieldname, $post_ID = null, $default = null)
{
  $group = get_field($groupname, $post_ID);

  if ($group && is_array($group) && count($group)) {
    if (isset($group[$fieldname])) {
      return $group[$fieldname];
    } else {
      return $default;
    }
  } else {
    return $default;
  }
}

/**
 * Get an ACF group field value, with validation and an option for defaults
 *
 * Returns null if the group/field was not available and no default was set
 *
 * @example acf_get_group_field( 'mygroup', 'groupfield', 'option', 'HelloWorld' );
 *
 * @param   string  $groupname  ACF group name
 * @param   string  $fieldname  Field name within the group
 * @param   int     $post_ID    (Optional) Post ID. Defaults to null (ie. the global post)
 * @param   mixed   $default    (Optional) Default value. Defaults to null
 *
 * @return  mixed               The group field value. If the group field was not available, returns either null or the specified default
 */
function acf_get_sub_group_field($groupname, $fieldname, $post_ID = null, $default = null)
{
  $field = $default;
  if (have_rows($groupname, $post_ID)) {
    while (have_rows($groupname, $post_ID)) {
      the_row();
      $field = get_sub_field($fieldname);
    }
  }
  return $field;
}


// Links
// ============================================================================

/**
 * Get the target attribute, from an ACF link field
 *
 * @param   array  $link_field   Link field (must be set to return an array, not the URL)
 *
 * @return  string               Target attribute string, or empty string if the target is "_self" or not set
 */
function acf_link_target($link_field = null)
{
  return ($link_field && ($link_field['target'] !== '_self')) ? 'target="' . $link_field['target'] . '"' : '';
}


/**
 * Get markup for an HTML link (`<a href="">...</a>`).
 *
 * Optionally returns an error comment if no link was set
 *
 * @param   array  $link_field  ACF link field
 *
 * @return  string              Link markup
 */
function acf_link_markup($link = null, $text_replacement = null, $debug_on = false)
{
  if (!$link) {
    if ($debug_on) {
      return '<!--[acf_link_markup] No link set-->';
    } else {
      return '';
    }
  }

  $text = ($text_replacement) ? $text_replacement : $link['title'];

  ob_start();
  ?>

  <a href="<?= $link['url']; ?>" <?= acf_link_target($link); ?>>
    <?= $text ?>
  </a>

  <?php
  return ob_get_clean();
}