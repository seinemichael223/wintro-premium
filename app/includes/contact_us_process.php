<?php
// Function to process a contact form submission
function process_contact_form($data) {
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
    if (empty($data['phoneNo']) || !preg_match('/^\\d{3}-\\d{7,8}$/', $data['phoneNo'])) {
        // If Phone Number is empty or doesn't match the format, add an error message
        $errors[] = 'Phone Number is required and must be in the format 011-36014183.';
    }    

    // If there are no validation errors, proceed with processing the form
    if (empty($errors)) {
        // Prepare the recipient's email address (admin@example.com can be changed)
        $to = 'admin@example.com';
        // Prepare the subject of the email (use a default value if the 'subject' is not provided in the form data)
        $subject = $data['subject'] ?? 'Contact Form Submission';
        // Prepare the message body by collecting the form data and formatting it
        $message = "Name: " . htmlspecialchars($data['fn']) . "\n" .   // Sanitize Full Name
                   "Email: " . htmlspecialchars($data['Email']) . "\n" . // Sanitize Email
                   "Phone: " . htmlspecialchars($data['phoneNo']) . "\n" . // Sanitize Phone Number
                   "Company: " . htmlspecialchars($data['cn'] ?? '') . "\n" .  // Sanitize Company (optional)
                   "Message: " . htmlspecialchars($data['message'] ?? ''); // Sanitize Message (optional)

        // Uncomment the following line in production to actually send the email
        // mail($to, $subject, $message);  // Send the email to the administrator

        // Set the success flag to true if email is ready to be sent
        $success = true;
    }

    // Return the validation errors (if any) and the success flag to the caller
    return ['errors' => $errors, 'success' => $success];
}
?>

