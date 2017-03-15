<?php
/*
 * Plugin Name:       Featured Galleries
 * Plugin URI:        http://wordpress.org/plugins/featured-galleries/
 * Description:       WordPress ships with a Featured Image functionality. This adds a very similar functionality, but allows for full featured galleries with multiple images.
 * Version:           1.7.1
 * Author:            Andy Mercer
 * Author URI:        http://www.andymercer.net
 * Text Domain:       featured-galleries
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
*/

require_once(plugin_dir_path(__FILE__).'featured-galleries/components/enqueuing.php');
require_once(plugin_dir_path(__FILE__).'featured-galleries/components/metabox.php');
require_once(plugin_dir_path(__FILE__).'featured-galleries/components/ajax-update.php');
require_once(plugin_dir_path(__FILE__).'featured-galleries/components/readmethods.php');

add_action('add_meta_boxes', 'fg_register_metabox');
add_action('save_post', 'fg_save_perm_metadata', 1, 2);
add_action('admin_enqueue_scripts', 'fg_enqueue_stuff');
add_action('wp_ajax_fg_update_temp', 'fg_update_temp');

// Hook the textdomain in
add_action('plugins_loaded', 'fg_load_textdomain');
add_filter('fg_post_types', 'add_featured_galleries_to_cpt');
// add_action('init', 'gallery_cpt'); // create galleries as CPT

function fg_load_textdomain()
{
    load_plugin_textdomain('featured-gallery', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}


function add_featured_galleries_to_cpt($post_types)
{
    $post_types = array('page','ball-street'); // ($post_types comes in as array('post','page'). If you don't want FGs on those, you can just return a custom array instead of adding to it. )
    return $post_types;
}


function gallery_cpt()
{
    $single_name = "Gallery";
    $plural_name = "Galleries";
    $menu_icon = "dashicons-images-alt2";

    $type_labels = array(
      'name' => _x($plural_name, 'post type general name'),
      'singular_name' => _x($single_name, 'post type singular name'),
      'add_new' => _x('Add New ' . $single_name, 'video'),
      'add_new_item' => __('Add New ' . $single_name),
      'edit_item' => __('Edit ' . $single_name),
      'new_item' => __('Add New ' . $single_name),
      'all_items' => __('View ' . $plural_name),
      'view_item' => __('View ' . $single_name),
      'search_items' => __('Search ' . $plural_name),
      'not_found' =>  __('No ' . $plural_name . ' found'),
      'not_found_in_trash' => __('No ' . $plural_name . ' found in Trash'),
      'parent_item_colon' => '',
      'menu_name' => $plural_name
    );

    $type_args = array(
      'labels' => $type_labels,
      'public' => true,
      'publicly_queryable' => true,
      'query_var' => true,
      'rewrite' => array( 'slug' => strtolower(str_replace(" ", "-", $single_name))),
      'rewrite' => true,
      'capability_type' => 'post',
      'has_archive' => true,
      'hierarchical' => true,
      'map_meta_cap' => true,
      'menu_position' => null,
      'supports' => array('title','editor','thumbnail'),
      'taxonomies' => array('category'),
      'menu_icon' => $menu_icon
    );
    register_post_type($plural_name, $type_args);
}
