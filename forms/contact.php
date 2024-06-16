<?php
// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Please fill out all fields and provide a valid email address.";
    exit;
}

// Sanitize input fields
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

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
    error_log("Failed to send email: $email_subject");
    echo "Oops! Something went wrong and we couldn't send your message.";
}
?>
