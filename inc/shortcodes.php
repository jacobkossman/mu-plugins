<?php
function custom_shortcodes_init()
{
    function youtube_sc($id)
    {
        extract(shortcode_atts(array(
            'id' => 'id'
        ), $id));

        return '<div class="video-embed" data-type="youtube" data-video-id="' . $id . '"></div>';
    }
    add_shortcode('youtube', 'youtube_sc');

    function vimeo_sc($id)
    {
        extract(shortcode_atts(array(
            'id' => 'id'
        ), $id));

        return '<div class="video-embed" data-type="vimeo" data-video-id="' . $id . '"></div>';
    }
    add_shortcode('vimeo', 'vimeo_sc');

    function custom_sc($url)
    {
        extract(shortcode_atts(array(
            'url' => 'url'
        ), $url));

        return '<video preload="auto" controls><source src="' . $url . '" type="video/mp4"></video>';
    }
    add_shortcode('custom-video', 'custom_sc');
}
add_action('init', 'custom_shortcodes_init');
