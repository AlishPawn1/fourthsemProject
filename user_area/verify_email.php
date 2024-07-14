<?php
include ("../include/connect_database.php");
include ('user_header.php');


if (isset($_POST['verify'])) {
    $user_email = $_POST['email'];
    $verification_code = $_POST['verification_code'];

    // Verify the code against the database
    $query = "SELECT * FROM user_table WHERE user_email = '$user_email' And verification_code = '$verification_code'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Update user's email verification status
        $update_query = "UPDATE `user_table` SET email_verified = 1 WHERE user_email = '$user_email'";
        mysqli_query($conn, $update_query);
        echo "<script>alert('Your email has been successfully verified.');</script>";
        echo "<script>window.open('login-user.php', '_self')</script>";
    } else {
        echo "<script>alert('Invalid verification code. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link rel="stylesheet" href="loginstyle.css">
    <style>
        .btn-box {
            background-color: black;
            font-size: 20px;
            color: white;
            margin-top: 20px;
            padding: 14px 16px;
            border-radius: 8px;
            border: .5px solid black;
            width: calc(100% - 32px);
            display: block;
            text-align: center;
            text-decoration: none;
        }

        .btn-box:hover {
            color: #eeeeee;
            transform: scale(.98);
        }
    </style>
</head>

<body>
    <section class="single-banner bg-light-white margin-top-header">
        <div class="container">
            <div class="content">
                <h1 class="heading">My Account</h1>
                <div class="breadcrumb m-0">
                    <a href="../index.php">Home</a>
                    <span>/</span>
                    <span>My Account</span>
                </div>
            </div>
        </div>
    </section>

    <section class="login-user padding-top-section">
        <div class="container">
            <h4 class="heading">Verify Your Email</h4>
            <form action="verify_email.php" method="post">
                <div class="row pb-5">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="username">Email <span class="required">*</span></label>
                            <input type="text/email" name="email" class="form-input" required>
                        </div>
                        <div class="input form-group">
                            <label class="textlabel" for="verification_code">Verification Code</label>
                            <input type="text" class="form-input" id="verification_code" name="verification_code"
                                autocomplete="off" required />
                        </div>
                        <div class="form-row d-flex gap-2 align-items-center">
                            <button type="submit" class="btn white-btn checkout-btn" name="verify">Verify</button>
                            <br>
                            <a href="login-user.php" class="btn read-more checkout-btn">Login</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>



    <?php include ("user_footer.php"); ?>