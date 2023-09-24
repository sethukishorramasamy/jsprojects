<!DOCTYPE html>
<html lang="en">

<head>
    <script src="./removeBanner.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Entry</title>
    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
</head>

<body>
<?php
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $number = $_POST["number"];

    $errors = array();

    if (empty($email) || empty($number)) {
        array_push($errors, "All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($number) != 10) {
        array_push($errors, "Phone Number must be 10 characters long");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        require_once "database.php"; // Include your database configuration

        $sql = "INSERT INTO userDetails (email, number) VALUES (?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $email, $number);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>Created successfully!</div>";
        } else {
            die("Something went wrong");
        }
    }
}
?>

    <div style="padding:0px 10px">
    <div class="card container p-5 mt-5 mb-5" style="background-color:rgb(145, 201, 228);">
        <h1 class="p-1 text-center">User Details</h1>
        <form id="data-form" class="mt-3" action="saveUserDetails.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email Address</label>
                <input type="email" name="email" placeholder="name@example.com" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputMobile" class="form-label">Mobile Number</label>
                <input type="number" class="form-control" name="number" placeholder="Phone Number">
                <div class="form-text">We'll never share your contact with anyone else.</div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" name="submit" class="btn text-center p-2 btn-success" id="increment-btn"
                style="color: white; width: 80px;margin-top: 10px;">ADD</button>
        </form>
    </div>
    <div class="card container p-5 mt-5 mb-4" style="background-color:rgb(145, 201, 228);">
        <div class="mt-3">
            <a href="details.php" style="text-decoration: none;">View Previous Entry's</a>
            <p class="form-text" style="margin-top: -3px;">(*office work's only)</p>
        </div>
    </div>

    </div>
</body>

</html>