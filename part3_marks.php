<?php
include("database.php");

if (isset($_GET['semester'])) {
    // Retrieve the "semester" data from the query parameter
    $semester = $_GET['semester'];

    // Now you can use the $semester variable as needed on this page
    echo "Selected Semester: " . $semester;
} else {
    echo "Semester data not found in the URL.";
}

// Query to retrieve data
$sql = "SELECT name, regno, semester, part, subject1, subject_code1, mark1, subject2, subject_code2, mark2, subject3, subject_code3, mark3 FROM part_3 WHERE semester = '$semester'"; // Replace "your_table" with your table name
$result = mysqli_query($conn, $sql); 

if (mysqli_num_rows($result) > 0) {
    $highestMark = -1;
    $studentWithHighestMark = "";
    $regiseter_no = "";
    
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row["name"];
        $mark1 = $row["mark1"];
        $mark2 = $row["mark2"];
        $mark3 = $row["mark3"];
        $total = $mark1 + $mark2 + $mark3;
        $regno = $row["regno"];
        

        if ($total > $highestMark) {
            $highestMark = $total;
            $studentWithHighestMark = $row; // Store the entire row data
        }
    }

    if ($highestMark >= 0) {
        echo "<h2>Highest Mark:</h2>";
        echo "<div style='border: 2px solid #ccc; padding: 20px; width: 450px; margin: 20px auto; font-weight: bolder; font-size: 18px;'>";
        echo "<h3 style='text-align: center;'>Student Details</h3>";
        echo "<p>Name: " . $studentWithHighestMark["name"] . "</p>";
        echo "<p>Register No: " . $studentWithHighestMark["regno"] . "</p>";
        echo "<p>Semester: " . $studentWithHighestMark["semester"] . "</p>";
        echo "<p>Part: " . $studentWithHighestMark["part"] . "</p>";
        echo "<p>Subject's: " . $studentWithHighestMark["subject1"] . ",  " . $studentWithHighestMark["subject2"] . ",  " . $studentWithHighestMark["subject3"] . "</p>";
        echo "<p>Subject Code's: " . $studentWithHighestMark["subject_code1"] . ",  " . $studentWithHighestMark["subject_code2"] . ",  " . $studentWithHighestMark["subject_code3"] ."</p>";
        echo "<p>Mark's: " . $studentWithHighestMark["mark1"] . ",  " . $studentWithHighestMark["mark2"] . ",  " . $studentWithHighestMark["mark3"] . "</p>";
        echo "<p>Total Mark: " . $highestMark . "</p>";
        echo "</div>";
    } else {
        echo "<p>No data found.</p>";
    }

    // Now, you can display the entire table as before
    mysqli_data_seek($result, 0);
    
    echo "<h2>All Data:</h2>";
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th style='padding: 10px;'>Name</th>";
    echo "<th style='padding: 10px;'>Registration Number</th>";
    echo "<th style='padding: 10px;'>Semester</th>";
    echo "<th style='padding: 10px;'>Part</th>";
    echo "<th style='padding: 10px;'>Subject1</th>";
    echo "<th style='padding: 10px;'>Subject Code1</th>";
    echo "<th style='padding: 10px;'>Mark1</th>";
    echo "<th style='padding: 10px;'>Subject2</th>";
    echo "<th style='padding: 10px;'>Subject Code2</th>";
    echo "<th style='padding: 10px;'>Mark2</th>";
    echo "<th style='padding: 10px;'>Subject3</th>";
    echo "<th style='padding: 10px;'>Subject Code3</th>";
    echo "<th style='padding: 10px;'>Mark3</th>";
    echo "<th style='padding: 10px;'>Total</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["name"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["regno"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["semester"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["part"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["subject1"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["subject_code1"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["mark1"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["subject2"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["subject_code2"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["mark2"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["subject3"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["subject_code3"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["mark3"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["mark1"] + $row["mark2"] + $row["mark3"] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No data found.";
}

mysqli_close($conn);
?>

<html>
    <head>
    <style>
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
                top: 100px;
                left: 200px;
            }

            /* Hover effect */
            .button-link:hover {
                background-color: #555;
            }
        </style>

    </head>
<body>
    <a href="form.php" class="button-link">Back</a>
</body>
</html>
