<?php
/**
 * Contact Form Handler
 * A simple PHP script to handle contact form submissions
 */

// Configuration
$admin_email = "admin@example.com";
$success_message = "Thank you! Your message has been received.";
$error_message = "Oops! Something went wrong. Please try again.";

// Initialize variables
$name = $email = $subject = $message = "";
$errors = [];
$success = false;

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $errors[] = "Name is required";
    } else {
        $name = sanitize_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $errors[] = "Only letters and spaces allowed in name";
        }
    }
    
    // Validate email
    if (empty($_POST["email"])) {
        $errors[] = "Email is required";
    } else {
        $email = sanitize_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
    }
    
    // Validate subject
    if (empty($_POST["subject"])) {
        $errors[] = "Subject is required";
    } else {
        $subject = sanitize_input($_POST["subject"]);
    }
    
    // Validate message
    if (empty($_POST["message"])) {
        $errors[] = "Message is required";
    } else {
        $message = sanitize_input($_POST["message"]);
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        // In a real application, you would send an email here
        // For demo purposes, we'll just save to a file
        $log_entry = date("Y-m-d H:i:s") . " | ";
        $log_entry .= "Name: $name | Email: $email | Subject: $subject | Message: $message\n";
        
        file_put_contents("contact_messages.log", $log_entry, FILE_APPEND);
        
        $success = true;
        
        // Clear form fields after successful submission
        $name = $email = $subject = $message = "";
    }
}

/**
 * Sanitize user input
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 600px;
            width: 100%;
        }
        
        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 600;
        }
        
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        input:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
        }
        
        textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        button:hover {
            transform: translateY(-2px);
        }
        
        .error {
            background: #fee;
            color: #c00;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #fcc;
        }
        
        .success {
            background: #efe;
            color: #060;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #cfc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📧 Contact Us</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="error">
                <strong>Please fix the following errors:</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="subject">Subject *</label>
                <input type="text" id="subject" name="subject" value="<?php echo $subject; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="message">Message *</label>
                <textarea id="message" name="message" required><?php echo $message; ?></textarea>
            </div>
            
            <button type="submit">Send Message</button>
        </form>
    </div>
</body>
</html>
