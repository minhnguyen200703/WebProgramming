<?php 
    session_start();
    ob_start();

     // Valide at server side again before saving user input to the text file.
     include_once('validator.php');
     $is_duplicate = false;
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         // Get user input via POST request
         $username = isset($_POST["username"]) ? $_POST['username'] : '';
         $password = isset($_POST["password"]) ? $_POST['password'] : '';
         $_SESSION['hashed_password'] = password_hash($password, PASSWORD_DEFAULT);
         $avatar = basename($_FILES['avatar']['name']);
         $business_name = isset($_POST["business_name"]) ? $_POST['business_name'] : '';
         $business_address = isset($_POST["business_address"]) ? $_POST['business_address'] : '';
 
         // Check whether username is already registered
         if (file_exists('./assets/storage/accounts.db')) {
             $account_file = fopen('./assets/storage/accounts.db', 'r');
             if ($account_file) {
                 // Read the file line by line
                 while (($account = fgets($account_file)) !== false) {
                     $account_details = explode('|', $account);
                     if ((trim($username) == trim($account_details[1]))) {
                         $is_duplicate = true;
                         break;
                     }
                 }
                 fclose($account_file);
             }
         }
 
         // Validate username at sever side
         if (empty($username)) {
             $usernameErr = "Name is required";
         } else if (!checkBetweenLength($username, 8, 15))  {
             $usernameErr = "The length of username must be between 6 and 20characters";
         } else {
             $usernameErr = "";
             $username = test_input($username);
         }
 
         // Validate password at sever side
         if (empty($password)) {
             $password_err = "Password is required";
         }  else if (!checkLowerCase($password))  {
             $password_err = "At least one lowercase character is required";
         } else if (!checkUpperCase($password))  {
             $password_err = "At least one uppercase character is required";
         } else if (!checkSymbol($password))  {
             $password_err = "At least one symbol is required";
         } else if (!checkNumber($password))  {
             $password_err = "At least one number is required";
         } else if (!checkBetweenLength($password, 6, 20))  {
             $password_err = "The length of username must be between 6 and 20 characters";
         } else {
             $password_err = "";
             $password = test_input($password);
         }
 
         // Validate real name of user at sever side
         if (empty($business_name)) {
             $business_name_err = "Password is required";
         } else if (!checkMinLength($business_name, 5)) {
             $business_name_err = "At least 5 characters is required";
         } else {
             $business_name_err = "";
             $business_name = test_input($business_name);
         }
 
         // Validate user address at sever side
         if (empty($business_address)) {
             $business_address_err = "Password is required";
         } else if (!checkMinLength($business_address, 5)) {
             $business_address_err = "At least 5 characters is required";
         } else {
             $business_address_err = "";
             $business_address = test_input($business_address);
         }
         
         // If all form fields satisfy the requirements, save the user data to the text file
         if ($username && $password && $business_name && $business_address && !$is_duplicate) {
             $user_type = "type2";  //type 1 represents for vendor accounts
             include_once('save_user_to_txt.php');
         }
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lazada</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Hachi+Maru+Pop&family=Hubballi&family=Inter:wght@300;400;500;600;700;800&family=Kalam:wght@700&family=Montserrat:wght@254&family=Open+Sans:wght@326;379&family=Permanent+Marker&family=Poppins:wght@100&family=Roboto:wght@300;400;700&family=Rubik+Glitch&display=swap');
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/registration_pages.css">
</head>
<body>
    <header>
        <a href="index.php" class="back_btn" id="vendor_back_btn"><i class="fa-solid fa-chevron-left"></i>Back</a>
    </header>
    <main>
        <div class="registration vendor">
            <div class="registration__left">
                <img src="assets/img/vendor_registration.png" alt="">
                <div class="registration__left_content">
                    <h2>Always welcome</h2>
                    <h3>Nice to meet u!</h3>
                    <hr>
                    <p class="registration__left_content__desc">
                        Lorem Ipsum is simply dummy text of the Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, and scrambled it to make a type specimen book.
                    </p>

                    <ul class="registration__left__more">
                        <li>
                            <a href="./privacy_policies.html">Policies</a>
                        </li>
                        <li>
                            <a href="./about.html">About</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="registration__right">
                <h2>Vendor Registration</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" class="registration__form" id="form_2">
                    <div class="form_field">
                        <label for="avatar" class="edit_btn form_field__label"> 
                            <img src="assets/img/mock_avt2.png" alt="" class="avt_block">
                            <i class="fa-solid fa-camera camera_icon"></i>
                        </label>
                        <input type="file" name="avatar" accept="image/*" id="avatar" onchange="loadFile(event)" style="display: none"> 
                        <img src="" alt="" id="output">
                        <span class="form_field__message"></span>
                    </div>

                    <div class="form_field">
                        <label for="username" class="form_field__label">Username</label>
                        <input type="text" class="form_field__input" id="username" placeholder="Enter username" name="username">
                        <span class="form_field__message"></span>
                    </div>
                  
                    <div class="form_field">
                        <label for="username" class="form_field__label">Password</label>
                        <input type="password" class="form_field__input" id="password" placeholder="Enter password" name="password">
                        <span class="form_field__message"></span>
                    </div>
               
                    <div class="form_field">
                        <label for="business_name" class="form_field__label">Business name</label>
                        <input type="text" class="form_field__input" id="business_name" placeholder="Enter your name" name="business_name">
                        <span class="form_field__message"></span>
                    </div>
                    <div class="form_field">
                        <label for="business_address" class="form_field__label">Business Address</label>
                        <input type="text" class="form_field__input" id="business_address" placeholder="Enter your business address" name="business_address">
                        <span class="form_field__message"></span>
                    </div>

                    <div class="form_field">
                        <input type="submit" name="submit_btn" id="submit_btn" class="form_field__label btn-hover color-2" value="Register">
                    </div>

                    <div class="registration__right__more">
                        <!-- <a href="">Forgot password?</a> -->
                        <p>Already have an account? <a href="" class="login_link">Login</a> now</p>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
    <!-- JS CODE -->
    <!-- Upload image script -->
    <script src="./assets/js/preview.js"></script>
    
    <!-- Validation -->
    <script src="./assets/js/validator.js" ></script>
    <script>
        var username = document.getElementById('username');
        var password = document.getElementById('password');
        var avatar = document.getElementById('avatar');
        var businessName = document.getElementById('business_name');
        var businessAddress = document.getElementById('business_address');
        var submitButton = document.getElementById('submit_btn');


        function formValidation() {
            let usernameValue = username.value.trim();
            let passwordValue = password.value.trim();

            let isValidUsername = false;
            let isValidPassword = false;

            // username validation
            if (!usernameValue) {
                showError(username, 'Not be blank')
            } else if (!onlyLettersAndNumbers(usernameValue)) {
                showError(username, 'Only letters and numbers are allowed')
            } else if (!checkBetweenLength(usernameValue, 8, 15)) {
                showError(username, 'The length of username must be between 8 and 15 characters')
            } else {
                isValidUsername = true;
                showSuccess(username)
            }

            // password validation
            if (!passwordValue) {
                showError(password, 'Not be blank')
            } else if (!checkLowerCase(passwordValue)) {
                showError(password, 'At least one lowercase character is required')
            } else if (!checkUpperCase(passwordValue)) {
                showError(password, 'At least one uppercase character is required')
            } else if (!checkSymbol(passwordValue)) {
                showError(password, 'At least one symbol is required')
            } else if (!checkNumber(passwordValue)) {
                showError(password, 'At least one number is required')
            } else if (!checkBetweenLength(passwordValue, 6, 20)) {
                showError(password, 'The length of username must be between 6 and 20 characters')
            } else {
                isValidPassword = true;
                showSuccess(password)
            }

            // name validation, address validation
            let isValidBusinessName = otherFieldValidation(businessName);
            let isValidBusinessAddress = otherFieldValidation(businessAddress);

            var isFileUploaded = false;
            console.log(avatar.value);
            if (avatar.value == "") {
                showError(avatar, 'Not be blank')
            } else {
                showSuccess(avatar)
                var isFileUploaded = true;
                console.log('not null');
            }

            if (isValidUsername && isValidPassword && isValidBusinessName && isValidBusinessAddress && isFileUploaded) {
                return true
            } 
            return false
        }

        // When click on submit button
        submitButton.addEventListener("click", function(event){
            let isValid =  formValidation()
            if (!isValid) {
                event.preventDefault()
            }
        }); 
    </script>
  
</body>
</html>

<?php 
    ob_end_flush();
?>