<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $department = htmlspecialchars($_POST['department']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Your email where the message will be sent
    $to = "your-email@example.com"; // Replace with your actual email address
    $subject = "New Contact Form Submission";
    $body = "You have received a new message from the contact form.\n\n"
          . "Name: $name\n"
          . "Email: $email\n"
          . "Department: $department\n\n"
          . "Message:\n$message\n";

    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send the message. Please try again.";
    }
} else {
    echo "Invalid request method.";
}
?>
