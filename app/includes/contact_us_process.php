<?php

require_once 'dbh-inc.php';  // Include the database connection file
// Include the model file to access the insert function
require_once 'contact_us_model.php';

// Function to process a contact form submission
function process_contact_form($data, $pdo) {
    $errors = [];
    $success = false;

    // Validation: Check if the Full Name field is filled
    if (empty($data['fn'])) {
        // If Full Name is empty, add an error message
        $errors[] = 'Full Name is required.';
    }

    // Validation: Check if the Email field is filled and is a valid email format
    if (empty($data['Email']) || !filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
        // If Email is empty or invalid, add an error message
        $errors[] = 'A valid Email is required.';
    }

    // Validation: Check if the Phone Number field is filled and matches the specific format (xxx-xxx-xxxx)
    if (empty($data['phoneNo']) || !preg_match('/^\d{3}-\d{7,8}$/', $data['phoneNo'])) {
        // If Phone Number is empty or doesn't match the format, add an error message
        $errors[] = 'Phone Number is required and must be in the format 011-36014183.';
    }

    // If there are no validation errors, proceed with saving the form data into the database
    if (empty($errors)) {
        // Save the contact form data into the database using the insert function from the model
        insert_contact_message($pdo, $data['fn'], $data['Email'], $data['phoneNo'], $data['cn'] ?? '', $data['subject'] ?? '', $data['message'] ?? '');

        // You can also send an email if necessary (this part is commented out)
        // Prepare the recipient's email address (admin@example.com can be changed)
        $to = 'xueqian0731@gmail.com';
        $subject = $data['subject'] ?? 'Contact Form Submission';
        $message = "Name: " . htmlspecialchars($data['fn']) . "\n" .
                   "Email: " . htmlspecialchars($data['Email']) . "\n" .
                   "Phone: " . htmlspecialchars($data['phoneNo']) . "\n" .
                   "Company: " . htmlspecialchars($data['cn'] ?? '') . "\n" .
                   "Message: " . htmlspecialchars($data['message'] ?? '');

        // Uncomment the following line in production to actually send the email
        // mail($to, $subject, $message);  // Send the email to the administrator

        // Set the success flag to true if everything is processed successfully
        $success = true;
    }

    // Return the validation errors (if any) and the success flag to the caller
    return ['errors' => $errors, 'success' => $success];
}
?>

