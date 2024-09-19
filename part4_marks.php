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
$sql = "SELECT name, regno, semester, part, subject, subject_code, mark FROM part_4 WHERE semester = '$semester'"; // Replace "your_table" with your table name
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $highestMark = -1;
    $studentWithHighestMark = "";

    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row["name"];
        $mark = $row["mark"];

        if ($mark > $highestMark) {
            $highestMark = $mark;
            $studentWithHighestMark = $row; // Store the entire row data
        }
    }

    if ($highestMark >= 0) {
        echo "<div style='border: 2px solid #ccc; padding: 20px; width: 300px; margin: 20px auto; font-weight: bolder; font-size: 18px;'>";
        echo "<h2 style='text-align: center;'>Highest Mark</h2>";
        echo "<p>Name: " . $studentWithHighestMark["name"] . "</p>";
        echo "<p>Registration Number: " . $studentWithHighestMark["regno"] . "</p>";
        echo "<p>Semester: " . $studentWithHighestMark["semester"] . "</p>";
        echo "<p>Part: " . $studentWithHighestMark["part"] . "</p>";
        echo "<p>Subject: " . $studentWithHighestMark["subject"] . "</p>";
        echo "<p>Subject Code: " . $studentWithHighestMark["subject_code"] . "</p>";
        echo "<p>Mark:<b> " . $studentWithHighestMark["mark"] . "</b></p>";
        echo "</div>";
    } else {
        echo "<p>No data found.</p>";
    }

    // Now, you can display the entire table as before
    mysqli_data_seek($result, 0);

    echo "<h2>All Data:</h2>";
    echo "<table border=1 style='margin: 0 auto; border-collapse: collapse; width: 80%;'>";
    echo "<tr>";
    echo "<th style='padding: 10px;'>Name</th>";
    echo "<th style='padding: 10px;'>Registration Number</th>";
    echo "<th style='padding: 10px;'>Semester</th>";
    echo "<th style='padding: 10px;'>Part</th>";
    echo "<th style='padding: 10px;'>Subject</th>";
    echo "<th style='padding: 10px;'>Subject Code</th>";
    echo "<th style='padding: 10px;'>Mark</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["name"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["regno"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["semester"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["part"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["subject"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["subject_code"] . "</td>";
        echo "<td style='padding: 10px; text-align: center;'>" . $row["mark"] . "</td>";
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


