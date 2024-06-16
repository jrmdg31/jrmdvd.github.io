<?php
// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Please fill out all fields and provide a valid email address.";
    exit;
}

// Sanitize input fields
$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Set up the email recipient, subject, and body
$to = "davidjeromejerome351@gmail.com"; // Replace with your email address
$email_subject = "New contact form submission: $subject";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email\n\nMessage:\n$message";

// Set headers
$headers = "From: $email\n";
$headers .= "Reply-To: $email\n";

// Send the email
if(mail($to, $email_subject, $email_body, $headers)) {
    http_response_code(200);
    echo "Your message has been sent. Thank you!";
} else {
    http_response_code(500);
    echo "Oops! Something went wrong and we couldn't send your message.";
}
?>
