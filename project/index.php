<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<div>
    <?php
    function cleanData($data) // function for cleaning data
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }
    function showValidNameErr($data) //function for check input data is not number
    {
        if (is_numeric($data)) {

            return false;
        } else {
            return true;
        }
    }
    $name = $fname = $email = $mobile = $address = '';
    $nameErr = $emailErr = $mobileErr = $textErr = $fathErr = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Checking name
        if (showValidNameErr($_POST['name'])) {
            $name = cleanData($_POST['name']);
        } else {
            $nameErr = "Please enter valid name...";
        }
        if (showValidNameErr($_POST['fname'])) { // checking father's name
            $fname = cleanData($_POST['fname']);
        } else {
            $fathErr = "Please enter valid name...";
        }
        if (strlen(($_POST['mob'])) == 10) { // checking mobile number
            $mobile = cleanData($_POST['mob']);
        } else {
            $mobileErr = "Mobile number should be 10 digit...";
        }

        $email = $_POST['email'];
        $address = $_POST['address'];
    }
    ?>
</div>

<body>
    <div class="mainDiv">
        <div class="formDiv">
            <h1 align="center">Student Registration Form</h1>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="labl">
                    <label for="name">First Name:</label><br>
                    <input type="text" name="name" id="name" class="frm" required>
                    <div class="showErr"><small><?php echo $nameErr; ?></small></div>
                </div>
                <div class="labl">
                    <label for="fname">Father's Name:</label><br>
                    <input type="text" name="fname" id="fname" class="frm" required>
                    <div class="showErr"><small><?php echo $fathErr; ?></small></div>
                </div>
                <div class="labl">
                    <label for="mob">Mob No:</label><br>
                    <input type="text" name="mob" id="mob" class="frm" required>
                    <div class="showErr"><small><?php echo $mobileErr; ?></small></div>
                </div>
                <div class="labl">
                    <label for="email">Email:</label><br>
                    <input type="text" name="email" id="email" class="frm" required>
                    <div class="showErr"><small><?php echo $emailErr; ?></small></div>
                </div>
                <div class="labl">
                    <label for="textarea">Address:</label><br>
                    <textarea class="txtar" name="address" id="textarea" cols="100" rows="11" required></textarea>
                    <div class="showErr"><small><?php echo $textErr; ?></small></div>
                </div>
                <div class="labl">
                    <input type="submit" name="submit" class="frm btn" required>
                </div>
            </form>
        </div>
    </div>
</body>

<div class="detail">
    <hr>
    <table class="tbl">
        <th colspan="5">YOUR DATA</th> // Display data
        <tr>
            <td>Name</td>
            <td>Father's Name</td>
            <td>Mobile No.</td>
            <td>Email</td>
            <td>Address</td>
        </tr>
        <tr>
            <td><?php echo $name ?></td>
            <td><?php echo $fname ?></td>
            <td><?php echo $mobile ?></td>
            <td><?php echo $email ?></td>
            <td><?php echo $address ?></td>
        </tr>
    </table>
</div>

</html>