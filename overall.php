<?php
include("database.php");

// Initialize an array to store student data
$studentData = array();

for ($selectedSemester = 1; $selectedSemester <= 6; $selectedSemester++) {
    // Fetch data from the respective tables for the selected semester
    if ($selectedSemester >= 1 && $selectedSemester <= 4) {
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
    } elseif ($selectedSemester == 5 || $selectedSemester == 6) {
        // Fetch data from part_3 table for semester 5 or 6
        $sql = "SELECT regno, name, mark1 + mark2 + mark3 AS total_mark
                FROM part_3
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
}

// Define a custom sorting function to sort by total marks in descending order
function sortByTotalMarks($a, $b) {
    return $b['total_mark'] - $a['total_mark'];
}

// Sort the student data using the custom sorting function
uasort($studentData, 'sortByTotalMarks');

// Slice the top three performers
$topThreeToppers = array_slice($studentData, 0, 3);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Top Three Performers</title>
    <!-- Include your CSS styles here -->

    <style>
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
    </style>
</head>
<body>
    <h1>Top Three Performers</h1>

    <?php
    if (!empty($topThreeToppers)) {
        $ranking = 1;
        foreach ($topThreeToppers as $performer) {
            echo "<div class='id-card'>";
            echo "<div class='id-card-header'>";
            echo "<h2 class='id-card-heading'>Top Performer #$ranking</h2>";
            echo "</div>";
            echo "<div class='id-card-body'>";
            echo "<div class='id-card-details'>";
            echo "<div class='id-card-field'>Name: " . $performer["name"] . "</div>";
            echo "<div class='id-card-field'>Registration Number: " . $performer['regno'] . "</div>";
            echo "<div class='id-card-field'>Total Marks: " . $performer["total_mark"] . "</div>";
            echo "<div class='id-card-field'>Percentage: " . round($performer["total_mark"] / 30, 2) ."%  </div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            $ranking++;
        }
    } else {
        echo "No data found for any semester.";
    }
    ?>

    <a href="form.php" class="button-link">Back</a>
</body>
</html>
