<?php

declare(strict_types=1);

// Function to insert contact form data into the contact_us table
function insert_contact_message(object $pdo, string $name, string $email, string $phone, ?string $company, string $subject, string $message)
{
    // Prepare the SQL query to insert the data into the contact_us table
    $query = "INSERT INTO contact_us (name, email, company, phone, subject, message, date_created) 
              VALUES (:name, :email, :company, :phone, :subject, :message, NOW())";
    
    // Prepare the statement
    $stmt = $pdo->prepare($query);
    
    // Bind the parameters to the SQL query
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":company", $company);
    $stmt->bindParam(":subject", $subject);  // Bind the subject parameter
    $stmt->bindParam(":message", $message);
    
    // Execute the statement
    $stmt->execute();
}

?>
