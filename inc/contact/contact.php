<?php

add_action('wp_ajax_sendContact', 'contact_formSubmit');
add_action('wp_ajax_nopriv_sendContact', 'contact_formSubmit');
add_action('wp_enqueue_scripts', 'contact_enqueueScript', 20, 1);
add_action('init', 'contactform_init');

function contact_enqueueScript()
{
    wp_enqueue_script('contact-form-js', plugin_dir_url(__FILE__).'contact.js', '', null, true);

    wp_localize_script('contact-form-js', 'meta',
      array(
          'ajaxurl' => admin_url('admin-ajax.php'),
          'nonce' => wp_create_nonce("contact")
      )
  );
}

function contact_formSubmit()
{
    global $post;
    $email = get_option('contact_email');
    if (empty($_POST['password'])) {
        $success = false;

        $name = isset($_POST['name']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name']) : "";
        $emailaddress = filter_var($_POST['emailaddress'], FILTER_SANITIZE_EMAIL);
        $message = isset($_POST['message']) ? preg_replace("/[^\.\-\' a-zA-Z0-9]/", "", $_POST['message']) : "";

        $to = $name.' <'.$emailaddress.'>';

        if ($name && $emailaddress && $message) {
            $subject = get_bloginfo('name') . " - Website Contact Form";

            $headers = 'From:' . $email . "\r\n";
            $headers .= 'Reply-To:' . $to . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html\r\n";
            $headers .= "charset: ISO-8859-1\r\n";
            $headers .= "X-Mailer: PHP/".phpversion()."\r\n";

            $formcontent = '<html><body><center>';
            $formcontent .= '<table rules="all" style="border: 1px solid #cccccc; width: 600px;" cellpadding="10">';
            $formcontent .= "<tr><td><strong>Name:</strong></td><td>" . $name . "</td></tr>";
            $formcontent .= "<tr><td><strong>Email:</strong></td><td>" . $emailaddress . "</td></tr>";
            $formcontent .= "<tr><td><strong>Message:</strong></td><td>" . $message . "</td></tr>";
            $formcontent .= '</table></center></body></html>';

            $success = mail($email, $subject, $formcontent, $headers);
        }

        // Return an appropriate response to the browser
        if (defined('DOING_AJAX')) {
            echo $success ? "Success" : "E";
        }
    }
    die();
}

function contactform_init()
{
    function contact_formCreate($class)
    {
        extract(shortcode_atts(array('class' => 'class'), $class));

        return "<form role='form' id='contactForm' class='" . $class . "' method='POST' action=''><div class='form-group'><input type='text' class='form-control' name='name' id='name' placeholder='name' required /></div><div class='form-group'><input type='email' class='form-control' name='emailaddress' id='emailaddress' placeholder='email' required /></div><div class='form-group'><textarea rows='7' class='form-control' name='message' id='message' placeholder='message' required /></textarea></div><div class='form-group text-right'><button type='submit' class='btn btn-primary'>Submit</button><input type='hidden' name='password' id='password' val='' /></div></form>";
    }

    add_shortcode('contact-form', 'contact_formCreate');
}


add_action('admin_init', 'contact_section');

function contact_section()
{
    add_settings_section(
      'contactform_section', // Section ID
      'Contact Form', // Section Title
      'contact_section_callback', // Callback
      'general' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field(// Option 2
      'contact_email', // Option ID
      'Contact Form Email', // Label
      'contact_callback', // !important - This is where the args go!
      'general', // Page it will be displayed
      'contactform_section', // Name of our section (General Settings)
      array( // The $args
          'contact_email' // Should match Option ID
      )
    );

    register_setting('general', 'contact_email', 'esc_attr');
}

function contact_section_callback()
{ // Section Callback
    echo '<p>Enter the email where responses to the contact form should go</p>';
}

function contact_callback($args)
{  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" class="regular-text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}
