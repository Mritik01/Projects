<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration form </title>
</head>
<?php
define('imgMaxSize', 2097152);
define('pdfMaxSize', 6291456);
$nameErr = $fnameErr = $emailErr = $mobileErr = $uploadPhotoErr = $uploadSignErr = "";
$name = $fname = $email = $mobile = $uploadPhoto = $uploadSign = "";


if (isset($_POST['submit'])) { // Checking Name

    // Validating form data
    $name = $_POST['name'];
    if (is_numeric($name) || preg_match("/\d+/", $name)) {
        $nameErr = "Please enter valid name...";
    } elseif (strlen($name) < 3) {
        $nameErr = "Your name is too short...";
    } else {
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        // echo $name;
    }

    $fname = $_POST['fname'];
    if (is_numeric($fname) || preg_match("/\d+/", $fname)) {
        $fnameErr = "Please enter valid name...";
    } elseif (strlen($fname) < 3) {
        $fnameErr = "Your name is too short...";
    } else {
        $fname = filter_var($fname, FILTER_SANITIZE_STRING);
        // echo $fname;
    }

    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Please enter valid email...";
    } else {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    $mobile = $_POST["mobile"];
    // if(!filter_var($mobile,FILTER_SANITIZE_NUMBER_INT)){
    //     $mobileErr="Please enter valid number...";
    // }
    if (!filter_var($mobile, FILTER_VALIDATE_INT)) {
        $mobileErr = "Please enter valid email...";
    } else {
        $mobile = filter_var($mobile, FILTER_SANITIZE_NUMBER_INT);
    }


    /*---------------------Upload for image ----------------------------*/
    $imgDir = "";
    $imgFile = $imgDir . $_FILES['passphoto']['name'];
    $uploadDone = 1;
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    $imgSize = $_FILES['passphoto']['size'];

    if (file_exists($imgFile)) {
        $uploadPhotoErr = "File already exist...";
        $uploadDone = 0;
    }
    if ($imgSize > imgMaxSize) {
        $uploadPhotoErr = "File size too large...";
        $uploadDone = 0;
    }
    if ($imgExt != 'png' && $imgExt != 'jpeg' && $imgExt != 'jpg' && $imgExt && 'gif') {
        $uploadPhotoErr = "This is not an image...";
        $uploadDone = 0;
    }

    if ($uploadDone) {
        if (move_uploaded_file($_FILES['passphoto']['tmp_name'], $imgFile)) {
            $uploadPhotoErr = "Your file has been uploaded...";
        } else {
            $uploadPhotoErr = "Somthing went wrong...";
        }
    }

    /*------------------- Upload for pdf -----------------------------*/

    $pdfDir = "";
    $pdfFile = $pdfDir . $_FILES['sign']['name'];
    $uploadPdfDone = 1;
    $pdfExt = strtolower(pathinfo($pdfFile, PATHINFO_EXTENSION));
    $pdfSize = $_FILES['sign']['size'];


    if (file_exists($pdfFile)) {
        $uploadSignErr = "File already exist...";
        $uploadPdfDone = 0;
    }
    if ($pdfSize > pdfMaxSize) {
        $uploadSignErr = "File size too large...";
        $uploadPdfDone = 0;
    }
    if ($pdfExt != 'pdf') {
        $uploadSignErr = "This is not a pfd file...";
        $uploadPdfDone = 0;
    }
    if ($uploadPdfDone) {
        if (move_uploaded_file($_FILES['sign']['tmp_name'], $pdfFile)) {
            $uploadSignErr = "Your file has been uploaded...";
        } else {
            $uploadSignErr = "Somthing went wrong...";
        }
    }
}

?>

<body>

    <div class="container">
        <h1>Student Registration Form</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <div class="form">
                <label for="name">Name<span>*</span>:</label><br>
                <input type="text" name="name" id="name" class="inputtag addPaddingInput" required><br>
                <small><?php echo $nameErr ?></small>
            </div>

            <div class="form">
                <label for="fname">Father's Name<span>*</span>:</label><br>
                <input type="text" name="fname" id="fname" class="inputtag addPaddingInput" required><br>
                <small><?php echo $fnameErr ?></small>
            </div>

            <div class="form">
                <label for="email">Email<span>*</span>: </label><br>
                <input type="email" name="email" id="email" class="inputtag addPaddingInput" placeholder="example@somthing.com" required><br>
                <small><?php echo $emailErr ?></small>
            </div>
            <div class="form">
                <label for="mobile">Mobile<span>*</span>: </label><br>
                <input type="text" name="mobile" id="mobile" class="inputtag addPaddingInput" required><br>
                <small><?php echo $mobileErr ?></small>
            </div>
            <div class="form">
                <label for="passphoto">Upload Photo<small>(image)</small><span>*</span>:</label><br>
                <input type="file" name="passphoto" id="passphoto" class="inputtag" required><br>
                <small><?php echo $uploadPhotoErr ?></small>
            </div>
            <div class="form">
                <label for="sign">Upload Signature<small>(pdf)</small><span>*</span>:</label><br>
                <input type="file" name="sign" id="sign" class="inputtag" required><br>
                <small><?php echo $uploadSignErr ?></small>
            </div>
            <div class="form">
                <input type="submit" name="submit" value="Submit" class="inputtag btn" required><br>
            </div>
        </form>
    </div>

    <div class="showData">
        <table border="1">
            <th colspan="5">Your Data</th>
            <tr>
                <td>Your Photo</td>
                <td>Your Name</td>
                <td>Your Father's Name</td>
                <td>Your Email ID.</td>
                <td>Your Mobile No.</td>
            </tr>
            <tr>
                <td><img src="<?php echo $imgFile ?> " height=200px width=200px></td>
                <td><?php echo $name ?></td>
                <td><?php echo $fname ?></td>
                <td><?php echo $email ?></td>
                <td><?php echo $mobile ?></td>

            </tr>

        </table>
    </div>
</body>

</html>