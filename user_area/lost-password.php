<?php include ("../header.php"); ?>

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
<section class="padding-top-section">
    <div class="container">
        <p>Lost your password? Please enter your username or email address. You will receive a link to create a new
            password via email.</p>
        <form action="">
            <div class="row pb-5">
                <div class="col-sm-6">
                    <div class="">
                        <label for="username">Username or email</label>
                        <input type="text/email" class="form-input" required>
                    </div>
                    <input type="submit" class="btn white-btn mt-3 checkout-btn" value="RESET PASSWORD">
                </div>
            </div>
        </form>
    </div>
</section>

<?php include ("../Footer.php"); ?>