<?php

/*
Plugin Name: Custom Must-Use Plugin
Description: Adds custom functionality for wordpress theme
Version: 1.0.0
Author: Jacob Kossman
Author URI: https://www.koss.mn
*/

// general utility functions
require_once(plugin_dir_path(__FILE__).'inc/utilities.php');

// adds company info to settings > general
require_once(plugin_dir_path(__FILE__).'inc/company.php');

// adds social media to settings > general
require_once(plugin_dir_path(__FILE__).'inc/social.php');

// adds custom post types
// require_once(plugin_dir_path(__FILE__).'inc/cpts.php');

// disable comments and relevant pages
// require_once(plugin_dir_path(__FILE__).'inc/disable-comments.php');

// adds functionality for contact form
require_once(plugin_dir_path(__FILE__).'inc/contact/contact.php');

// adds featured galleries to pages and posts for theme use
require_once(plugin_dir_path(__FILE__).'inc/featured-galleries.php');

// adds SEO meta / OpenGraph tags to head
require_once(plugin_dir_path(__FILE__).'inc/seo-tags.php');

// custom shortcodes
require_once(plugin_dir_path(__FILE__).'inc/shortcodes.php');
