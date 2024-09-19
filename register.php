<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <style>
        /* Add your CSS styles for formatting here */
        body {
            background-color: #ffdb58;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 400px;
            text-align: center;
            position: relative; /* Added for positioning the registration link */
        }

        .login-container h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .input-container {
            margin: 20px 0;
            position: relative;
        }

        .input-container input {
            width: 100%;
            padding: 15px;
            border: none;
            background-color: #f5f5f5;
            border-radius: 25px;
            outline: none;
            font-size: 18px;
            color: #333;
        }

        .input-container label {
            position: absolute;
            top: -20px;
            left: 20px;
            font-size: 16px;
            color: #ffdb58;
            background-color: #333;
            padding: 5px 10px;
            border-radius: 15px;
        }

        .login-button {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 15px 45px;
            font-size: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .left {
            position: relative;
            left: -40px;
            width: 150px;
        }

        .right {
            position: relative;
            right: -60px;
            width: 150px;
        }

        .login-button:hover {
            background-color: #ffdb58;
            color: #333;
        }

        /* Style the registration link within the login container */
        .login-container a {
            text-decoration: none;
            color: #333;
        }

        #error {
            color: red;
        }
    </style>
</head>
<body>

    <div class="login-container" id="registration-form">
        <h2>Register</h2>
        <form id="registration" action="register.php" method="POST">
            <div class="input-container">
                <label for="new-username">New Username:</label>
                <input type="text" id="new-username" name="new-username" required>
            </div>
            <div class="input-container">
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new-password" required>
            </div>
            <button type="submit" class="login-button">Register</button>
        </form>
        <p id="error"></p>
    </div>

    <?php
        // Database connection information
        $servername = "localhost";  // Change to your MySQL server hostname
        $username = "root";         // Change to your MySQL username
        $password = "";             // Change to your MySQL password
        $database = "saranya";          // Change to your MySQL database name

        // Create a connection to the MySQL server
        $conn = new mysqli($servername, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the form is for registration
            if (isset($_POST['new-username']) && isset($_POST['new-password'])) {
                // Retrieve user data from the registration form
                $newUsername = $_POST['new-username'];
                $newPassword = $_POST['new-password'];
                
                
                // Hash the password using the PASSWORD_BCRYPT algorithm
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                // SQL query to insert data into the "student" table for registration
                $sql = "INSERT INTO login (username, password) VALUES ('$newUsername', '$hashedPassword')";

                if ($conn->query($sql) === TRUE) {
                    // echo "Registration successful.";
                    header("Location: form.php");
                } else {
                    echo '<script type="text/javascript">document.getElementById("error").innerHTML = "User Name was already Taken";</script>';
                    //  "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }    
        // Close the database connection
        $conn->close();
    ?>

</body>
</html>
