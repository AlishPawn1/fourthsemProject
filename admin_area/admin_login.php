<?php 

include('header.php'); 

?>

<section class="admin_login padding-top-section">
    <div class="container">
        <div class="content">
            <h4 class="heading">Login</h4>
            <form action="login.php" method="post">
                <div class="row pb-5">
                    <div class="col">
                        <div class="form-group">
                            <label for="admin_name">Username <span class="required">*</span></label>
                            <input type="text/email" name="admin_name" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="admin_password" class="form-input password" required>
                            <input type="checkbox" class="showPassword">
                        </div>
                        <div class="form-row d-flex gap-2 align-items-center">
                            <input type="submit" class="btn white-btn checkout-btn" value="login" name="admin_login">
                        </div>
                        <div class="d-none">
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?  <a href="admin_registration.php" class="text-danger">Register</a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php 

include('footer.php'); 

?>
