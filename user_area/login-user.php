 
<?php include('user_header.php');  ?>
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
        <h4 class="heading">Login</h4>
        <form action="login.php" method="post">
            <div class="row pb-5">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="username">Email <span class="required">*</span></label>
                        <input type="text/email" name="user_email" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="user_password" class="form-input password" required>
                        <input type="checkbox" class="showPassword">
                    </div>
                    <div class="form-row d-flex gap-2 align-items-center">
                        <input type="submit" class="btn white-btn checkout-btn" value="login" name="user_login">
                    </div>
                    <div class="">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?  <a href="user_registration.php" class="text-danger">Register</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include("user_footer.php"); ?>
