<?php

/**
 * Add HTTP to url if doesn't exist
 **/

function addhttp($url)
{
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

/**
 * Custom Exceprt Length
 **/

remove_filter('the_excerpt', 'wp_trim_excerpt'); // remove default wp filter
add_filter('the_excerpt', 'trim_excerpt'); // add custom filter

function trim_excerpt($content)
{
    $max_chars = 125;
    $allow_cutoff = false;
    $allow_specialchars = true;

    $content = strip_tags($content);
    $content = html_entity_decode($content, ENT_COMPAT, 'UTF-8'); // decode html entities to characters with (charset UTF-8)
if (strlen($content) > $max_chars) {
    $content = substr($content, 0, $max_chars);
    if (!$allow_cutoff) {
        $last_space = strrpos($content, ' '); // find the last space in string to avoid word cut-off
$content = substr($content, 0, $last_space);
    }
    trim($content); // trim in case last char is a space;
if (!$allow_specialchars) {
    while (eregi('[[:punct:]]$', $content)) {
        $content = trim(eregi_replace('[[:punct:]]$', '', $content));
    } // strip last char if punctuation
}
}
    $more_string = '...'; // the "read more" link
    if (strlen($content) > $max_chars) {
        return $content.$more_string;
    } else {
        return $content;
    }
}
