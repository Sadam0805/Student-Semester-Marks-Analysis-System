<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
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

    <div class="login-container">
        <h2>Login</h2>
        <form id="login" action="login.php" method="POST">
            <div class="input-container">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-container">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
        <!-- Registration link inside the login container -->
        <p>Don't have an account? <a href="register.php" id="show-registration">Register here</a></p>
        <!-- <br> -->
        <p id="error"></p>
    </div>

    <?php
        // Database connection information
        $servername = "localhost";  // Change to your MySQL server hostname
        $username = "root";         // Change to your MySQL username
        $password = "";             // Change to your MySQL password
        $database = "student_merit";          // Change to your MySQL database name

        // Create a connection to the MySQL server
        $conn = new mysqli($servername, $username, $password, $database);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the form is for login
        if (isset($_POST['username']) && isset($_POST['password'])) {
            // Retrieve user data from the login form
            $inputUsername = $_POST['username'];
            $inputPassword = $_POST['password'];

            // SQL query to retrieve user data for login
            $sql = "SELECT * FROM student WHERE username = '$inputUsername'";

            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $storedPassword = $row['password'];

                // Verify the entered password with the stored password using password_verify
                if (password_verify($inputPassword, $storedPassword)) {

                    if ($inputUsername == "admin") {
                        header("Location: admin.php");
                    } else {
                        // echo "Login successful. Welcome, $inputUsername!";
                        header("Location: form.php");
                    }
                    
                } else {
                    // echo "Login failed. Incorrect password.";
                    echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Login failed. Incorrect password.";</script>';
                }
            } else {
                // echo " <br><br><br>Login failed. User not found.";
                echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Login failed. User not found.";</script>';
            }
        }
        //  else {
        //     echo "Invalid form submission.";
        // }
       
        // Close the database connection
        $conn->close();
    ?>


</body>
</html>
