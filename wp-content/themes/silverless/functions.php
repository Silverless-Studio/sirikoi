<?php
/**
 * silverless functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package silverless
 */

require_once 'silverless-config.php';
include_once 'acf-utility.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function silverless_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on silverless, use a find and replace
	 * to change 'silverless' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('silverless', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	register_nav_menus(
		array(
			'main-menu' => esc_html__('Primary', 'silverless'),
			'sub-menu' => esc_html__('Secondary', 'silverless'),
			'footer-menu' => esc_html__('Footer', 'silverless'),
			'footer-menu-lower' => esc_html__('Legal', 'silverless'),
			'pre-menu' => esc_html__('Pre Prep', 'silverless'),
			'prep-menu' => esc_html__('Prep', 'silverless'),
			'contact-menu' => esc_html__('Contact', 'silverless'),
			'about-menu' => esc_html__('About', 'silverless'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'silverless_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);

	silverless_setup_roles();

	remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
	remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
}
add_action('after_setup_theme', 'silverless_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function silverless_content_width()
{
	$GLOBALS['content_width'] = apply_filters('silverless_content_width', 640);
}
add_action('after_setup_theme', 'silverless_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function silverless_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'silverless'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'silverless'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'silverless_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function silverless_scripts()
{
	global $silverless_config;
	wp_enqueue_style('silverless-style', get_template_directory_uri() . '/inc/assets/css/main.css', array(), $silverless_config['version']);
	wp_style_add_data('silverless-style', 'rtl', 'replace');

	wp_enqueue_style('silverless-vendor-style', get_template_directory_uri() . '/inc/assets/css/vendor.css', array(), $silverless_config['version']);

	wp_enqueue_script('jquery');
	wp_enqueue_script('silverless-scripts', get_template_directory_uri() . '/inc/assets/js/bundle.js', array('jquery'), $silverless_config['version'], true);

	wp_register_script('fontawesome', 'https://kit.fontawesome.com/dc2cdfd0db.js', array(), null, true);
	wp_enqueue_script('fontawesome');

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'silverless_scripts');



function silverless_setup_roles()
{
	$owner = add_role('owner', 'Owner', get_role('administrator')->capabilities);

	if (!$owner) {
		$owner = get_role('owner');
	}

	$owner->remove_cap('edit_theme_options');
	$owner->remove_cap('export');
	$owner->remove_cap('import');
	$owner->remove_cap('manage_categories');
	$owner->remove_cap('manage_options');
	$owner->remove_cap('switch_themes');
	$owner->remove_cap('upload_files');
	$owner->remove_cap('customize');
	$owner->remove_cap('delete_site');
	$owner->remove_cap('install_plugins');
	$owner->remove_cap('install_themes');
	$owner->remove_cap('delete_themes');
	$owner->remove_cap('delete_plugins');
	$owner->remove_cap('edit_plugins');
	$owner->remove_cap('edit_themes');
	$owner->remove_cap('edit_files');
}

function silverless_user_role_dropdown($all_roles)
{
	$roles = (array) wp_get_current_user()->roles;

	if (in_array("owner", $roles)) {
		unset($all_roles['administrator']);
	}

	return $all_roles;
}
add_filter('editable_roles', 'silverless_user_role_dropdown');

function silverless_acf_google_map_api($api)
{
	$api['key'] = 'AIzaSyClrCRpYppmoqOu5RPPM-Aj71LsNq6lMHY';
	return $api;
}
add_filter('acf/fields/google_map/api', 'silverless_acf_google_map_api');

if (function_exists('acf_add_options_page')) {
	acf_add_options_page(
		array(
			'page_title' => 'Admin Settings',
			'menu_title' => 'Admin Settings',
			'menu_slug' => 'site-general-settings',
			'capability' => 'edit_posts',
			'redirect' => false
		)
	);

	acf_add_options_page(
		array(
			'page_title' => 'Default Content',
			'menu_title' => 'Default Content',
			'menu_slug' => 'site-default-content',
			'capability' => 'edit_posts',
			'redirect' => false
		)
	);
}

add_filter('show_admin_bar', '__return_false');
add_filter('use_block_editor_for_post', '__return_false', 10);

function silverless_dashboard_widget()
{
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'Technical Support', 'silverless_dashboard_help');
}

function silverless_dashboard_help()
{
	echo file_get_contents(__DIR__ . "/admin-settings/dashboard.html");
}

/* Dashboard Config */
add_action('wp_dashboard_setup', 'silverless_dashboard_widget');

/* Dashboard Style */
add_action('admin_head', 'silverless_custom_fonts');

function silverless_custom_fonts()
{
	echo '<style type="text/css">' . file_get_contents(__DIR__ . "/inc/assets/css/admin.css") . '</style>';
}

add_filter('acf/fields/flexible_content/layout_title/name=flex_content', 'my_acf_fields_flexible_content_layout_title', 10, 4);
function my_acf_fields_flexible_content_layout_title($title, $field, $layout, $i)
{
	if (is_numeric($i)) {


		//Display cards
		if ($cards = get_sub_field('cards')) {
			$title .= '<span class="acf-block-preview"><span>&#x23;</span><span>' . count($cards) . '</span></span>';

		} else {

			// Display hero thumbnail image.
			if ($image = get_sub_field('background_image')) {
				$title .= '<div class="thumbnail acf-block-preview"><img src="' . esc_url($image['sizes']['thumbnail']) . '" height="24px" /></div>';
			}
			// Display thumbnail image.
			if ($image = get_sub_field('image')) {
				$title .= '<div class="thumbnail acf-block-preview"><img src="' . esc_url($image['sizes']['thumbnail']) . '" height="24px" /></div>';
			}
			// Display title sub field
			if ($text = get_sub_field('title')) {
				$title .= '<span class="acf-block-preview"><span>Title</span><span>' . esc_html($text) . '</span></span>';
			}
			// Display feed type
			if ($feed = get_sub_field('feed')) {
				$title .= '<span class="acf-block-preview"><span>Type</span><span>' . esc_html($feed) . '</span></span>';
			}
			// Display colour
			if ($colour = get_sub_field('colour')) {
				$title .= '<span class="acf-block-preview"><span>Colour</span><span class="acf-block-preview-color background__color__' . esc_html($colour) . '">&nbsp;</span></span>';
			}

		}

		if ($container_width = get_sub_field_object('container_width')) {
			$title .= '<span class="acf-block-preview"><span>&#x21e4; &#x21e5;</span><span>' . esc_html($container_width['value']) . '</span></span>';
		}

		// Display spacer size
		if ($spacer = get_sub_field_object('space_size')) {
			$title .= '<span class="acf-block-preview"><span>&#x2193;</span><span>' . esc_html($spacer['choices'][$spacer['value']]) . '</span></span>';
		}

		if ($default_content = get_sub_field_object('content_block')) {
			$current = $default_content['value'][0]['acf_fc_layout'];
			$layout = array_filter($default_content['layouts'], fn($layout) => $layout['name'] == $current);

			if ($layout && is_array($layout)) {
				$title .= '<span class="acf-block-preview"><span>Block</span><span>' . esc_html(reset($layout)['label']) . '</span></span>';
			}
		}
	}
	return $title;
}

// Function to change "posts" to "news" in the admin side menu
function change_post_menu_label()
{
	global $menu;
	global $submenu;
	$menu[5][0] = 'News Articles';
	$submenu['edit.php'][5][0] = 'News Articles';
	$submenu['edit.php'][10][0] = 'Add News Article';
	$submenu['edit.php'][16][0] = 'Tags';
	echo '';
}
add_action('admin_menu', 'change_post_menu_label');
// Function to change post object labels to "news"
function change_post_object_label()
{
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'News Articles';
	$labels->singular_name = 'News Article';
	$labels->add_new = 'Add News Article';
	$labels->add_new_item = 'Add News Article';
	$labels->edit_item = 'Edit News Article';
	$labels->new_item = 'News Article';
	$labels->view_item = 'View News Article';
	$labels->search_items = 'Search News Articles';
	$labels->not_found = 'No News Articles found';
	$labels->not_found_in_trash = 'No News Articles found in Trash';
}
add_action('init', 'change_post_object_label');

// Add action to check for ACF field and redirect if necessary
add_action('template_redirect', 'redirect_pages_with_embedded_content');

function redirect_pages_with_embedded_content()
{
	if (is_singular('page')) {
		$page_id = get_queried_object_id();
		$embedded_content = get_field('embed_page', $page_id);

		if ($embedded_content) {
			wp_redirect(home_url());
			exit;
		}
	}
}

add_action('wp_head', 'prevent_indexing_of_pages_with_embedded_content');
function prevent_indexing_of_pages_with_embedded_content()
{
	if (is_singular('page')) {
		$page_id = get_queried_object_id();
		$embedded_content = get_field('embed_page', $page_id);
		if ($embedded_content) {
			echo '<meta name="robots" content="noindex, nofollow">';
		}
	}
}

function custom_givewp_iframe_styles()
{
	global $silverless_config;
	wp_enqueue_style(
		'givewp-iframes-styles',
		get_template_directory_uri() . '/inc/assets/css/givewp-iframes-styles.css',
		/**
		 *  Below, use 'give-sequoia-template-css' to style the Multi-Step donation
		 *  'give-classic-template' to style the Classic template
		 *  or 'give-styles' to style the Donor Dashboard
		 */
		['give-sequoia-template-css'],
		$silverless_config['version']
	);
}

add_action('wp_print_styles', 'custom_givewp_iframe_styles', 10);