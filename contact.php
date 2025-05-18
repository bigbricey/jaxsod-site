<?php 
$pageTitle = "Contact Us - Jax Sod Inc."; 
$message_sent = false;
$error_message = '';

// Define recipient email
$recipient_email = "info@jaxsod.com";

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Invalid email format.';
    } elseif (empty($name) || empty($message)) {
        $error_message = 'Please fill in all required fields.';
    } else {
        // Prepare email
        $subject = "Website Contact Form Submission from: " . $name;
        $body = "You have received a new message from your website contact form.\n\n";
        $body .= "Name: " . $name . "\n";
        $body .= "Email: " . $email . "\n";
        $body .= "Message:\n" . $message . "\n";

        // Set headers
        $headers = "From: noreply@jaxsod.com\r\n"; // Use a domain email for better deliverability
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Send email
        if (mail($recipient_email, $subject, $body, $headers)) {
            $message_sent = true;
        } else {
            $error_message = 'Sorry, there was an error sending your message. Please try again later or contact us directly via phone.';
        }
    }
}

include("header.php"); 
?>

<div class="container page-content">
    <h2>Contact Us</h2>
    <p>Ready to transform your lawn? Get in touch with us today for a free estimate or to ask any questions.</p>
    
    <h3>Contact Information:</h3>
    <ul>
        <li><strong>Phone:</strong> <a href="tel:9049011457">(904) 901-1457</a></li>
        <li><strong>Email:</strong> <a href="mailto:<?php echo $recipient_email; ?>"><?php echo $recipient_email; ?></a></li>
        <li><strong>Service Area:</strong> Jacksonville, FL and surrounding areas.</li>
    </ul>

    <h3>Send us a Message</h3>

    <?php if ($message_sent): ?>
        <div class="alert alert-success" role="alert">
            Thank you! Your message has been sent successfully.
        </div>
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <?php if (!$message_sent): // Only show form if message hasn't been sent ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="contact-form">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required class="form-control" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required class="form-control" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required class="form-control"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Send Message</button>
        </div>
    </form>
    <?php endif; ?>

</div>

<?php include("footer.php"); ?>

