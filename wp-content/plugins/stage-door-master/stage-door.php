<?php /*
Plugin Name: Stage Door
Plugin URI:  https://silverless.co.uk
Description: Displaying the Silverless-branded log in screen.
Version:     1.0
Author:      Silverless
*/
function add_my_stylesheet()
{
    wp_enqueue_style( 'myCSS', plugins_url( '/style.css', __FILE__ ) );
}
add_action('login_head', 'add_my_stylesheet');
?>
