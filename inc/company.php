<?php

add_action('admin_init', 'misc_section');

function misc_section()
{
    add_settings_section(
      'misc_section', // Section ID
      'Misc Info', // Section Title
      'misc_options_callback', // Callback
      'general' // What Page?  This makes the section show up on the General Settings Page
  );

    add_settings_field(// Option 2
          'instagram_token', // Option ID
          'Instagram Access Token', // Label
          'my_textbox_callback', // !important - This is where the args go!
          'general', // Page it will be displayed
          'misc_section', // Name of our section (General Settings)
          array( // The $args
              'instagram_token' // Should match Option ID
          )
      );


    register_setting('general', 'instagram_token', 'esc_attr');
}


// add_action('admin_init', 'company_contact_section');


function company_contact_section()
{
    add_settings_section(
        'company_contact_section', // Section ID
        'Company Contact Info', // Section Title
        'address_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );
    add_settings_field(// Option 1
        'address', // Option ID
        'Address', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'company_contact_section', // Name of our section (General Settings)
        array( // The $args
            'address' // Should match Option ID
        )
    );
    add_settings_field(// Option 1
        'address2', // Option ID
        'Address 2', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'company_contact_section', // Name of our section (General Settings)
        array( // The $args
            'address2' // Should match Option ID
        )
    );
    add_settings_field(// Option 1
        'city', // Option ID
        'City', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'company_contact_section', // Name of our section (General Settings)
        array( // The $args
            'city' // Should match Option ID
        )
    );
    add_settings_field(// Option 1
        'state', // Option ID
        'State', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'company_contact_section', // Name of our section (General Settings)
        array( // The $args
            'state' // Should match Option ID
        )
    );
    add_settings_field(// Option 1
        'zip', // Option ID
        'Zip', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'company_contact_section', // Name of our section (General Settings)
        array( // The $args
            'zip' // Should match Option ID
        )
    );
    add_settings_field(// Option 1
        'phone', // Option ID
        'Phone', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'company_contact_section', // Name of our section (General Settings)
        array( // The $args
            'phone' // Should match Option ID
        )
    );

    register_setting('general', 'address', 'esc_attr');
    register_setting('general', 'address2', 'esc_attr');
    register_setting('general', 'city', 'esc_attr');
    register_setting('general', 'state', 'esc_attr');
    register_setting('general', 'zip', 'esc_attr');
    register_setting('general', 'phone', 'esc_attr');
}

function misc_options_callback()
{ // Section Callback
    echo '<p>Miscellaneous information goes here.</p>';
}

function address_options_callback()
{ // Section Callback
    echo '<p>Enter your company info below to add it to the relevant areas.</p>';
}

function my_textbox_callback($args)
{  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" class="regular-text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}
