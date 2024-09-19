

<?php

    $semester = "";
    $part = "";
    $department = "";
    $studentclass = "";

    if (isset($_POST['semester'])) {
        $semester = $_POST['semester'];
    }

    if (isset($_POST['part'])) {
        $part = $_POST['part'];
    }

    if (isset($_POST['department'])) {
        $department = $_POST['department'];
    }

    if (isset($_POST['studentclass'])) {
        $studentclass = $_POST['studentclass'];
    }

    // Now you can safely use $semester, $part, $department, and $studentclass further in your code.


    if ($part === "1" && $department === "COMPUTER SCIENCE" && $studentclass === "BSC") {
        // Define the data you want to pass as query parameters
        $data = array(
            'semester' => $semester,
        );

        // Redirect to part1_marks.php with query parameters
        header("Location: part1_marks.php?" . http_build_query($data));
        exit;
    } elseif ($part === "2" && $department === "COMPUTER SCIENCE" && $studentclass === "BSC") {
        // Define the data you want to pass as query parameters
        $data = array(
            'semester' => $semester,
        );

        // Redirect to part2_marks.php with query parameters
        header("Location: part2_marks.php?" . http_build_query($data));
        exit;
    } elseif ($part === "3" && $department === "COMPUTER SCIENCE" && $studentclass === "BSC") {
        // Define the data you want to pass as query parameters
        $data = array(
            'semester' => $semester,
        );

        // Redirect to part3_marks.php with query parameters
        header("Location: part3_marks.php?" . http_build_query($data));
        exit;
    } elseif ($part === "4" && $department === "COMPUTER SCIENCE" && $studentclass === "BSC") {
        // Define the data you want to pass as query parameters
        $data = array(
            'semester' => $semester,
        );

        // Redirect to part4_marks.php with query parameters
        header("Location: part4_marks.php?" . http_build_query($data));
        exit;
    } else {
        // echo "Condition not met";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information Form</title>
    <style>
        /* Add creative CSS styling here */
        /* Add creative CSS styling here */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .form-container {
            width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #007bff;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #007bff;
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333; /* Font color for labels */
            font-size: 16px;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-family: 'Verdana', sans-serif;
            font-size: 16px;
            color: #333; /* Font color for input fields */
        }

        select {
            background-color: #f9f9f9;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            font-family: 'Arial', sans-serif;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        label {
            color: #458458;
            text-align: center;
            font-weight: bolder;
            font-size: 24px;
        }

        .topper {
            position: fixed;
            top: 100px;
            right: 60px;
            width: 100px;
            height: 60px;
            background-color: #450998;
            text-align: center;
        }

        a {
            color: white;
            text-decoration: none;
        }

    </style>

<script>
        function togglePartOptions() {
            var semesterSelect = document.getElementById("semester");
            var partSelect = document.getElementById("part");

            // Get the selected semester value
            var selectedSemester = semesterSelect.value;

            // Hide all "Part" options first
            var partOptions = partSelect.querySelectorAll("option");
            for (var i = 0; i < partOptions.length; i++) {
                partOptions[i].style.display = "block";
            }

            // Hide Part 1, Part 2, and Part 4 options when Semester 5 or 6 is selected
            if (selectedSemester == 5 || selectedSemester == 6) {
                partSelect.querySelector("option[value='1']").style.display = "none"; // Hide Part 1
                partSelect.querySelector("option[value='2']").style.display = "none"; // Hide Part 2
                partSelect.querySelector("option[value='4']").style.display = "none"; // Hide Part 4
            }
        }

        // Call the function on page load to initialize the state
        window.onload = togglePartOptions;
    </script>

</head>
<body>
    <div class="form-container">
        <h2>Student Information Form</h2>
        <form action="form.php" method="post">
            <label for="studentclass">Class:</label>
            <select id="studentclass" name="studentclass" required>
                <option value="BSC">BSC</option>
                <option value="BA">BA</option>
                <option value="BCA">BCA</option>
                <option value="BBA">BBA</option>
                <option value="B.COM">B.COM</option>
            </select>
            
            <label for="department">Department:</label>
            <select id="department" name="department" required>
                <option value="COMPUTER SCIENCE">COMPUTER SCIENCE</option>
                <option value="MATHEMATICS">MATHEMATICS</option>
                <option value="TAMIL">TAMIL</option>
                <option value="ENGLISH">ENGLISH</option>
                <option value="CHEMISTRY">CHEMISTRY</option>
                <option value="PHYSICS">PHYSICS</option>
            </select>
            
            <label for="shift">Shift:</label>
            <select id="shift" name="shift" required>
                <!-- <option value="Shift I">Shift I</option> -->
                <option value="Shift II">Shift II</option>
            </select>
            
            <label for="batch">Batch:</label>
            <select id="batch" name="batch" required>
                <option value="2019-2022">2019-2022</option>
            </select>

            
            <label for="semester">Semester:</label>
            <select id="semester" name="semester" required onchange="togglePartOptions()">
                <option value="1">Semester I</option>
                <option value="2">Semester II</option>
                <option value="3">Semester III</option>
                <option value="4">Semester IV</option>
                <option value="5">Semester V</option>
                <option value="6">Semester VI</option>
            </select>

            <label for="part">Part:</label>
            <select id="part" name="part">
                <option value="1">Part 1</option>
                <option value="2">Part 2</option>
                <option value="3">Part 3</option>
                <option value="4">Part 4</option>
            </select>            
            
            <button type="submit" onclick="redirectToNextPage()">Submit</button>
        </form>
    </div>

    <div class="topper">
        <a href="topper.php"><h3><strong>Topper</strong></h3></a>
    </div>
    <div style="background-color: green; color: white;">
        <a href="overall.php" style="text-align: center;"><h3><strong>Overall</strong></h3></a>
    </div>

</body>
</html>
