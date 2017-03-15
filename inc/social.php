<?php

add_action('admin_init', 'social_section');

function social_section()
{
    add_settings_section(
        'social_section', // Section ID
        'Social Media', // Section Title
        'my_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field(// Option 1
        'facebook', // Option ID
        'Facebook URL', // Label
        'social_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'social_section', // Name of our section (General Settings)
        array( // The $args
            'facebook' // Should match Option ID
        )
    );
    add_settings_field(// Option 2
        'twitter', // Option ID
        'Twitter URL', // Label
        'social_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'social_section', // Name of our section (General Settings)
        array( // The $args
            'twitter' // Should match Option ID
        )
    );
    add_settings_field(// Option 2
        'twitter_handle', // Option ID
        'Twitter Username', // Label
        'social_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'social_section', // Name of our section (General Settings)
        array( // The $args
            'twitter_handle' // Should match Option ID
        )
    );
    add_settings_field(// Option 2
        'instagram', // Option ID
        'Instagram URL', // Label
        'social_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'social_section', // Name of our section (General Settings)
        array( // The $args
            'instagram' // Should match Option ID
        )
    );

    // add_settings_field(// Option 2
    //     'soundcloud', // Option ID
    //     'Soundcloud URL', // Label
    //     'social_textbox_callback', // !important - This is where the args go!
    //     'general', // Page it will be displayed
    //     'social_section', // Name of our section (General Settings)
    //     array( // The $args
    //         'soundcloud' // Should match Option ID
    //     )
    // );

    add_settings_field(// Option 2
        'linkedin', // Option ID
        'LinkedIn URL', // Label
        'social_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'social_section', // Name of our section (General Settings)
        array( // The $args
            'linkedin' // Should match Option ID
        )
    );


    register_setting('general', 'facebook', 'esc_attr');
    register_setting('general', 'twitter', 'esc_attr');
    register_setting('general', 'twitter_handle', 'esc_attr');
    register_setting('general', 'instagram', 'esc_attr');
    register_setting('general', 'linkedin', 'esc_attr');
    // register_setting('general', 'soundcloud', 'esc_attr');
}

function my_section_options_callback()
{ // Section Callback
    echo '<p>Enter your social media links to have them displayed on your website.</p>';
}

function social_textbox_callback($args)
{  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" class="regular-text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}
