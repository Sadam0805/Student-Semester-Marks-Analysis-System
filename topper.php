
<!DOCTYPE html>
<html>
    <head>
        <title>Semester Selector</title>
        <style>
            /* Add your CSS styles here */
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
            }

            h1 {
                text-align: center;
                padding: 20px;
                background-color: #333;
                color: #fff;
                margin: 0;
            }

            form {
                max-width: 400px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            label {
                display: block;
                margin-bottom: 10px;
                font-weight: bold;
            }

            select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 16px;
                background-color: #fff;
                color: #333;
            }

            input[type="submit"] {
                display: block;
                width: 100%;
                padding: 10px;
                background-color: #333;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }

            input[type="submit"]:hover {
                background-color: #555;
            }

            .id-card {
                width: 300px;
                border: 2px solid #000;
                background-color: #fff;
                margin: 50px auto;
                padding: 20px;
                box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
                font-family: Arial, sans-serif;
            }

            .id-card-header {
                text-align: center;
            }

            .id-card-heading {
                font-size: 22px;
                margin: 0;
                padding: 10px 0; 
                color: red;
            }

            .id-card-body {
                display: flex;
                align-items: center;
                font-weight: bolder;
            }

            .id-card-details {
                flex-grow: 1;
            }

            .id-card-field {
                margin: 10px 0;
            }

               /* Style the link as a button */
            .button-link {
                display: inline-block;
                padding: 10px 20px;
                background-color: #333;
                color: #fff;
                text-decoration: none;
                border: 1px solid #333;
                border-radius: 4px;
                transition: background-color 0.3s ease;
                position: fixed;
                bottom: 100px;
                left: 200px;
            }

            /* Hover effect */
            .button-link:hover {
                background-color: #555;
            }

        </style>
    </head>

    <body>
        <h1>Select Semester</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="semester">Select Semester:</label>
            <select id="semester" name="semester">
                <option value="0">Choose Semester</option>
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
                <option value="3">Semester 3</option>
                <option value="4">Semester 4</option>
                <option value="5">Semester 5</option>
                <option value="6">Semester 6</option>
            </select>
            <input type="submit" value="Submit">
        </form>

        <a href="form.php" class="button-link">Back</a>

        <?php
            include("database.php");

            if (isset($_POST['semester'])) {
                $selectedSemester = $_POST['semester'];

                if ($selectedSemester >= 1 && $selectedSemester <= 4) {
                    // Initialize an array to store student data
                    $studentData = array();

                    // Fetch data from part_1, part_2, part_4 tables for the selected semester
                    for ($part = 1; $part <= 4; $part++) {
                        $tableName = "part_" . $part;

                        $markColumn = ($part == 3) ? "mark1 + mark2 + mark3" : "mark";

                        $sql = "SELECT regno, name, $markColumn as total_mark
                                FROM $tableName
                                WHERE semester = '$selectedSemester'";

                        $result = mysqli_query($conn, $sql);

                        if (!$result) {
                            die("Database query error: " . mysqli_error($conn));
                        }

                        // Calculate total marks for each student
                        while ($row = mysqli_fetch_assoc($result)) {
                            $regno = $row["regno"];
                            $total_mark = $row["total_mark"];

                            if (!isset($studentData[$regno])) {
                                $studentData[$regno] = [
                                    "name" => $row["name"],
                                    "total_mark" => $total_mark,
                                    "regno" => $regno,
                                ];
                            } else {
                                $studentData[$regno]["total_mark"] += $total_mark;
                            }
                        }
                    }

                    // Find the student with the highest total mark
                    $highestTotalMark = 0;
                    $topper = [];

                    foreach ($studentData as $regno => $data) {
                        if ($data["total_mark"] > $highestTotalMark) {
                            $highestTotalMark = $data["total_mark"];
                            $topper = $data;
                        }
                    }

                    // Display the result in ID card format
                    echo "<div class='id-card'>";
                    echo "<div class='id-card-header'>";
                    echo "<h2 class='id-card-heading'>Semester $selectedSemester Topper</h2>";
                    echo "</div>";
                    echo "<div class='id-card-body'>"; 
                    echo "<div class='id-card-details'>";
                    echo "<div class='id-card-field'>Name: " . $topper["name"] . "</div>";
                    echo "<div class='id-card-field'>Registration Number: " . $topper['regno'] . "</div>";
                    echo "<div class='id-card-field'>Total Marks: " . $highestTotalMark . "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                } elseif ($selectedSemester == 5 || $selectedSemester == 6) {
                    // Calculate the highest mark for semester 5 or 6 from part_3 table
                    $sql = "SELECT regno, name, mark1 + mark2 + mark3 AS total_mark
                            FROM part_3
                            WHERE semester = '$selectedSemester'
                            ORDER BY total_mark DESC
                            LIMIT 1";

                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        die("Database query error: " . mysqli_error($conn));
                    }

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $regno = $row["regno"];
                        $highestTotalMark = $row["total_mark"];

                        // Display the result in ID card format
                        echo "<div class='id-card'>";
                        echo "<div class='id-card-header'>";
                        echo "<h2 class='id-card-heading'>Semester $selectedSemester Topper</h2>";
                        echo "</div>";
                        echo "<div class='id-card-body'>";
                        echo "<div class='id-card-details'>";
                        echo "<div class='id-card-field'>Name: " . $row["name"] . "</div>";
                        echo "<div class='id-card-field'>Registration Number: " . $regno . "</div>";
                        echo "<div class='id-card-field'>Total Marks: " . $highestTotalMark . "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    } else {
                        echo "No data found for the selected semester.";
                    }
                } else {
                    // echo "Invalid semester selection.";
                }
            } else {
                // echo "Semester data not found in the form.";
            }

            mysqli_close($conn);
        ?>


    </body>
</html>