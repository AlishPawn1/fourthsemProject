<?php
if (isset($_GET['edit_account'])) {
    $username = $_SESSION["username"];
    $select_query = "SELECT * FROM `user_table` WHERE user_name = '$username'";
    $result_query = mysqli_query($conn, $select_query);
    $row_query = mysqli_fetch_array($result_query);
    $user_id = $row_query['user_id'];
    $user_name = $row_query['user_name'];
    $user_email = $row_query['user_email'];
    $user_address = $row_query['user_address'];
    $user_mobile = $row_query['user_mobile'];
    $user_password = $row_query['user_password'];
    $user_image = $row_query['user_image'];

    if (isset($_POST['user_update'])) {
        $update_id = $user_id;
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_mobile = $_POST['user_mobile'];
        $new_user_image = $_FILES['user_image']['name'];
        $new_user_image_temp = $_FILES['user_image']['tmp_name'];
        $user_password = $_POST['user_password'];

        // Check if a new image has been uploaded
        if (!empty($new_user_image)) {
            // Move the uploaded image to the appropriate directory
            move_uploaded_file($new_user_image_temp, "./user_image/$new_user_image");
            $user_image = $new_user_image; // Use the new image
        }

        // Update query
        $update_data = "UPDATE `user_table` SET 
            user_name = '$user_name', 
            user_email = '$user_email', 
            user_password = '$user_password', 
            user_address = '$user_address', 
            user_mobile = '$user_mobile', 
            user_image = '$user_image' 
            WHERE user_id = $user_id";
        $result_query = mysqli_query($conn, $update_data);

        if ($result_query) {
            echo "<script>alert('Data updated successfully');</script>";
        } else {
            echo "<script>alert('Data update failed');</script>";
        }
    }
}
?>

<style>
    .form-outline {
        position: relative;
    }

    .showPassword {
        position: absolute;
        top: 43%;
        transform: translateY(-50%);
        right: 15px;
        cursor: pointer;
    }

    .error-message {
        position: absolute;
        color: red;
        bottom: -6px;
        left: 0;
        font-size: 12px;
    }
</style>

<section class="edit-account">
    <div class="edit_form">
        <form id="editAccountForm" action="" method="post" enctype="multipart/form-data">
            <div class="form-outline">
                <input type="text" class="form-input" id="user_name" value="<?php echo $user_name; ?>" name="user_name">
                <span id="usernameError" class="error-message"></span>
            </div>
            <div class="form-outline">
                <input type="email" class="form-input" id="user_email" value="<?php echo $user_email; ?>"
                    name="user_email">
                <span id="emailError" class="error-message"></span>
            </div>
            <div class="form-outline">
                <input type="password" class="password form-input" id="user_password"
                    value="<?php echo $user_password; ?>" name="user_password">
                <span id="passwordError" class="error-message"></span>
                <input type="checkbox" class="showPassword">
            </div>
            <div class="form-outline mb-1">
                <input type="file" class="form-control" name="user_image">
                <img src='./user_image/<?php echo $user_image; ?>' alt='<?php echo $username; ?>'>
            </div>
            <div class="form-outline">
                <input type="text" class="form-input" id="user_address" value="<?php echo $user_address; ?>"
                    name="user_address">
                <span id="addressError" class="error-message"></span>
            </div>
            <div class="form-outline">
                <input type="text" class="form-input" id="user_mobile" value="<?php echo $user_mobile; ?>"
                    name="user_mobile">
                <span id="contactError" class="error-message"></span>
            </div>
            <input type="submit" class="read-more btn" value="Update" name="user_update">
        </form>
    </div>
</section>

<script>
    // Show/Hide Password
    document.querySelectorAll('.showPassword').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const passwordField = checkbox.previousElementSibling;
            if (checkbox.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    });

    // Client-side validation
    function validateUsername() {
        const usernameInput = document.getElementById("user_name");
        const usernameError = document.getElementById("usernameError");
        if (usernameInput.value.trim().length < 3) {
            usernameError.textContent = "Username must be at least 3 characters long.";
            return false;
        } else {
            usernameError.textContent = "";
            return true;
        }
    }

    function validateEmail() {
        const emailInput = document.getElementById("user_email");
        const emailError = document.getElementById("emailError");
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim())) {
            emailError.textContent = "Enter a valid email address.";
            return false;
        } else {
            emailError.textContent = "";
            return true;
        }
    }

    function validatePassword() {
        const passwordInput = document.getElementById("user_password");
        const passwordError = document.getElementById("passwordError");
        if (passwordInput.value.trim().length < 6 || !/[A-Z]/.test(passwordInput.value) || !/[a-z]/.test(passwordInput.value) || !/\d/.test(passwordInput.value)) {
            passwordError.textContent = "Password must contain at least 1 lowercase, 1 uppercase, and 1 number, and be 6 characters long.";
            return false;
        } else {
            passwordError.textContent = "";
            return true;
        }
    }

    function validateAddress() {
        const addressInput = document.getElementById("user_address");
        const addressError = document.getElementById("addressError");
        if (addressInput.value.trim().length < 5) {
            addressError.textContent = "Address must be at least 5 characters long.";
            return false;
        } else {
            addressError.textContent = "";
            return true;
        }
    }

    function validateContact() {
        const contactInput = document.getElementById("user_mobile");
        const contactError = document.getElementById("contactError");
        const contactValue = contactInput.value.trim();

        if (contactValue.length !== 10 || isNaN(contactValue) || contactValue.charAt(0) !== '9' || !['8', '6', '7'].includes(contactValue.charAt(1))) {
            contactError.textContent = "Contact must be a 10-digit number starting with 9 and the second digit must be 8, 6, or 7.";
            return false;
        } else {
            contactError.textContent = "";
            return true;
        }
    }

    document.getElementById("user_name").addEventListener("input", validateUsername);
    document.getElementById("user_email").addEventListener("input", validateEmail);
    document.getElementById("user_password").addEventListener("input", validatePassword);
    document.getElementById("user_address").addEventListener("input", validateAddress);
    document.getElementById("user_mobile").addEventListener("input", validateContact);

    document.getElementById("editAccountForm").addEventListener("submit", function (event) {
        if (!validateUsername() || !validateEmail() || !validatePassword() || !validateAddress() || !validateContact()) {
            event.preventDefault();
        }
    });
</script>