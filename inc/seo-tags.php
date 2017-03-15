<?php

function doctype_opengraph($output)
{
    return $output . '
    xmlns:og="http://opengraphprotocol.org/schema/"
    xmlns:fb="http://www.facebook.com/2008/fbml"';
}


function seo_tags()
{
    global $post;

    if (is_single() && get_the_excerpt()) {
        $excerpt = strip_tags(get_the_excerpt());
    } elseif (get_option("seo_excerpt") != "") {
        $excerpt = get_option("seo_excerpt");
    } else {
        $excerpt = get_bloginfo('description');
    } ?>

    <meta name="description" content="<?php echo $excerpt; ?>">
    <meta name="author" content="<?php echo bloginfo('name'); ?>">

    <?php if (is_single()) {
        $galleryArray = get_post_gallery_ids($post->ID);
        $thumb = wp_get_attachment_image_src($galleryArray[1], 'full', true);
        $twitter_thumb = wp_get_attachment_image_src($galleryArray[1], 'medium', true); ?>

  		<meta property="og:url" content="<?php the_permalink(); ?>"/>
  		<meta property="og:title" content="<?php single_post_title(''); ?>" />
      <meta property="og:description" content="<?= $excerpt; ?>" />
  		<meta property="og:type" content="article" />
  		<meta property="og:image" content="<?= $thumb[0]; ?>" />

      <meta property="article:author" content="<?= get_option("facebook"); ?>" />
      <meta property="article:published_time" content="<?php echo get_post_time('c') ?>" />
      <meta property="twitter:card" content="summary_large_image">
  		<meta property="twitter:title" content="<?php bloginfo('name'); ?>">
  		<meta property="twitter:description" content="<?= $excerpt; ?>">
  		<meta property="twitter:image" content="<?= $twitter_thumb[0]; ?>">
  		<meta property="twitter:url" content="<?php the_permalink() ?>" />
  		<meta property="twitter:domain" content="<?php echo site_url(); ?>">
      <meta property="twitter:creator" content="@<?= get_option('twitter_handle'); ?>">
  	<?php

    } else {
        ?>
  		<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
      <meta property="og:description" content="<?= $excerpt ?>" />
  		<meta property="og:type" content="website" />
  		<meta property="og:image" content="<?php echo bloginfo('template_directory'); ?>/assets/images/facebook_share.jpg" />

  		<meta property="twitter:card" content="summary_large_image">
  		<meta property="twitter:title" content="<?php bloginfo('name'); ?> - <?= trim(wp_title('', false)); ?>">
  		<meta property="twitter:description" content="<?= $excerpt; ?>">
  		<meta property="twitter:image" content="<?php echo bloginfo('template_directory'); ?>/assets/images/twitter_share.jpg">
  		<meta property="twitter:url" content="<?php the_permalink() ?>" />
  		<meta property="twitter:domain" content="<?php echo site_url(); ?>">
  	<?php

    }
}

add_filter('language_attributes', 'doctype_opengraph');

add_action('wp_head', 'seo_tags', 5);

add_action('admin_init', 'excerpt_section');

function excerpt_section()
{
    add_settings_section(
      'excerpt_section', // Section ID
      'SEO Options', // Section Title
      'seo_section_callback', // Callback
      'general' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field(// Option 2
      'seo_excerpt', // Option ID
      'Excerpt', // Label
      'excerpt_callback', // !important - This is where the args go!
      'general', // Page it will be displayed
      'excerpt_section', // Name of our section (General Settings)
      array( // The $args
          'seo_excerpt' // Should match Option ID
      )
    );

    register_setting('general', 'seo_excerpt', 'esc_attr');
}

function seo_section_callback()
{ // Section Callback
    echo '<p>Enter the general description for the website (this will appear whenever you share a page without an exisiting excerpt). If this is empty, tagline will be used instead.</p>';
}

function excerpt_callback($args)
{  // Textbox Callback
    $option = get_option($args[0]);
    echo '<textarea maxlength="160" type="text" class="regular-text" id="'. $args[0] .'" name="'. $args[0] .'">' . $option . '</textarea>';
}
