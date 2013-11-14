<?php

/**
 * Contact Page template
 *
 * This template displays a contact page. It will be used by a page with the
 * "contact" slug. Alternatively, change the file name and add a "Template
 * Name" comment to allow the template to be selected in the WordPress admin
 * section.
 *
 * The form uses basic validation to check that input is valid and does not
 * contain spam. There is also the option of filtering spam content before
 * sending. The contact form could be extended with JavaScript or HTML5
 * validation.
 *
 * If the EMAIL_LOG constant is defined, the form will also log submissions to
 * a file. The log file should be placed outside the root directory.
 */

/**
 * Settings and definitions
 *
 * General settings for the contact form. Note that EMAIL_TO could be set to a
 * custom field value or the results of get_bloginfo('admin_email').
 */
define('EMAIL_TO', 'example@example.com');
define('EMAIL_CC', '');
define('EMAIL_BCC', '');
define('EMAIL_FROM', 'sender@example.com');
define('EMAIL_SUBJECT', 'Website Enquiry');
//define('EMAIL_LOG', $_SERVER['DOCUMENT_ROOT'] . '/../log/contact.csv');


$blocked_ips = array(
    '31.184.238.52'         // bot attack to rfwp.com from 12-14/11/2013
);


/**
 * Contact form fields
 *
 * Array to hold the values of all the fields in the contact form. Note that
 * WordPress does not allow POST data to be called "name", "day", "month", or
 * "year".
 */
$fields = array(
    'username',
    'email',
    'subject',
    'message'
);

/**
 * Array to hold errors
 */
$error = array();

/**
 * Check whether form is completed and sent
 */
$done = false;

/**
 * Function to print input class name on validation
 */
function z_input_valid($field_name) {
    global $error;
    if(!empty($_POST)) {
        if(array_key_exists($field_name, $error)) {
            return 'invalid';
        } else {
            return 'valid';
        }
    }
}

/**
 * Function to print error message
 */
function z_error_message($field_name) {
    global $error;
    if(array_key_exists($field_name, $error)) {
        return "<span class=\"error\">{$error[$field_name]}</span>";
    }
}

/**
 * Function to remove spam code
 *
 * This function removes email headers and HTML tags that indicate spam. It is
 * an alternative to the spam check used on submission below. The check method
 * prevents spam being sent; this function allows spam to be sent but without
 * headers, scripts, or links.
 */
function z_remove_headers($string) {
    $headers = array(
        '/to\:/i',
        '/from\:/i',
        '/bcc\:/i',
        '/cc\:/i',
        '/Content\-Transfer\-Encoding\:/i',
        '/Content\-Type\:/i',
        '/Mime\-Version\:/i'
    );
    $string = preg_replace($headers, '', $string);
    $string = strip_tags($string);
    return $string;
}

/**
 * Clean POST data and assign to named variables
 */
foreach($fields as $key => $value) {
    $data = isset($_POST[$value]) ? $_POST[$value] : '';
    //$data = z_remove_headers($data); // alternative to spam check below
    $data = trim($data);
    $data = stripslashes($data); // prevent escaped quotes and slashes
    $$value = $data;
}

/**
 * Validate submitted data and send if no errors
 *
 * This checks for spam and prevents spam content from being sent. This is an
 * alternative to the z_remove_headers() function defined above.
 */
if(!empty($_POST)) {

    /**
     * Check required fields
     */

    // Check name
    if(empty($username)) {
        $error['username'] = 'required';
    }

    // Check email
    if(empty($email)) {
        $error['email'] = 'required';
    } elseif(
        preg_match('/[\(\)\<\>\,\;\:\\\"\[\]]/', $email)
        || !preg_match('/^[^@]+@[^@.]+\.[^@]*\w\w$/', $email)
    ) {
        $error['email'] = 'invalid email address';
    } else {
        // Verify domain is valid
        list($addr,$domain) = explode('@', $email);
        $domain .= '.';
        
        if (!checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')) {
            $error['email'] = 'invalid email address';
        }
    }

    // Check message
    if(empty($message)) {
        $error['message'] = 'required';
    }

    /**
     * Check for spam
     *
     * If common spam indicators are detected, this is recorded in the error
     * array and the message is not sent. This is used as a more aggressive
     * spam prevention method than the z_remove_headers() function defined
     * above.
     */
    $filter = array(
        'bcc:',
        'cc:',
        '%0ato:',
        '\nto:',
        'url:',
        'url=',
        'multipart',
        'content-type',
        '<a',
        '&lt;a',
        '<script',
        '&lt;script',
        'http:',
        'https:',
        'ftp:',
        'www.',
        'document.cookie',
        'document.write'
    );
    if (preg_match('/' . implode('|', $filter) . '/i', implode('', $_POST)) || in_array($_SERVER['REMOTE_ADDR'], $blocked_ips) ) {
        $error['spam'] = 'spam';
    }

    /**
     * If no errors, send message
     *
     * If no errors are detected, the message is assembled using the form
     * input and the settings defined at the start of the file. If the email
     * is to be sent in HTML format, define the email headers here.
     *
     * If EMAIL_LOG has been defined and a native CSV function exists, the
     * output is also written to a log file.
     */
    if(count($error) == 0) {

        // Sender IP
        $sender = $_SERVER['REMOTE_ADDR'];

        // Put message together and send
        $email_body = "Name: $username\n\n";
        $email_body .= "Email: $email\n\n";
        $email_body .= "Subject: $subject\n\n";
        $email_body .= "Message:\n\n$message";
        $email_body .= "\n\nSender IP: $sender";
        $email_headers = "From: $username  <$email>"; // alternatively EMAIL_FROM
        $email_headers .= EMAIL_CC != '' ? "\nCc:" . EMAIL_CC : '';
        $email_headers .= EMAIL_BCC != '' ? "\nBcc:" . EMAIL_BCC : '';
        //$email_headers .= "\nMIME-Version: 1.0"; // HTML format
        //$email_headers .= "\nContent-Type: text/html; charset=UTF-8"; // HTML format
        $email_result = mail(EMAIL_TO, EMAIL_SUBJECT, $email_body, $email_headers);

        // Write to log file
        if(defined('EMAIL_LOG') && function_exists('fputcsv')) {
            $log = fopen(EMAIL_LOG, 'a');
            $row = array(date('Y-m-d H:i'), $username, $email, $subject, $message, $sender);
            fputcsv($log, $row);
        }

        // Completed
        $done = true;

    }

}

?>
<?php get_header(); ?>

    <div class="main">

<?php if(have_posts()): ?>
<?php while(have_posts()): the_post(); // Start loop ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content('Read more'); // Print content ?>
<?php endwhile; ?>
<?php endif; ?>

<?php if($done): ?>
        <p>Your message has been sent. Thank you.</p>
<?php else: ?>

<?php if(array_key_exists('spam', $error)): ?>
        <p class="error">
            Your message appears to be spam, or you are submitting the form from an IP address known to be a source of spam. Please remove any links before 
            trying again.
        </p>
<?php elseif(count($error)): ?>
        <p class="error">Some fields contain errors. Please correct them and try again.</p>
<?php endif; ?>

        <form action="<?php the_permalink(); ?>" method="post">

            <p>
                <label for="username" class="label-text">Name</label>
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username); ?>" class="input-text required <?php echo z_input_valid('username'); ?>" />
                <?php echo z_error_message('username'); ?>
            </p>

            <p>
                <label for="email" class="label-text">Email</label>
                <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" class="input-text required email <?php echo z_input_valid('email'); ?>" />
                <?php echo z_error_message('email'); ?>
            </p>

            <p>
                <label for="subject" class="label-text">Subject</label>
                <input type="text" name="subject" id="subject" value="<?php echo htmlspecialchars($subject); ?>" class="input-text" />
            </p>

            <p>
                <label for="message" class="label-text">Message</label>
                <textarea name="message" id="message" class="input-text required <?php echo z_input_valid('message'); ?>"><?php echo htmlspecialchars($message); ?></textarea>
                <?php echo z_error_message('message'); ?>
            </p>

            <p>
                <input type="submit" value="Send Message" />
            </p>

        </form>

<?php endif; ?>

    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
