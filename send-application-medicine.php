<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $personal_statement = htmlspecialchars($_POST['personal_statement']);

    // Recipient email
    $to = "medicine.department@example.com"; // Replace with your department's email address

    // Email subject
    $subject = "New Application to Medicine Department";

    // Email body
    $message = "
    <html>
    <head>
        <title>New Application</title>
    </head>
    <body>
        <h2>New Application to Medicine Department</h2>
        <p><strong>First Name:</strong> $first_name</p>
        <p><strong>Last Name:</strong> $last_name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>Personal Statement:</strong></p>
        <p>$personal_statement</p>
    </body>
    </html>
    ";

    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "<script>alert('Application submitted successfully.'); window.location.href = 'index.html';</script>";
    } else {
        echo "<script>alert('Failed to send the application. Please try again later.'); window.history.back();</script>";
    }
} else {
    echo "Invalid Request";
}
?>
