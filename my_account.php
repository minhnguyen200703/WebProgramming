<?php 
    session_start();
    ob_start();
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == false) {
        header("Location: ./www/index.php"); 
        exit();
    } 
?>

<?php 
    if (isset($_POST['edit_profile_btn']) && $_POST['edit_profile_btn']) {
        include_once('validator.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate whether user upload a new avatar
            // Note: There is no need to apply test_input function for this field since the path could be affected.
            if (!checkFileUpload($_FILES['new_avatar'])) {
                $avt_err = "Please upload new avatar";
            } else {
                $avt_err = "";
                $avatar = basename($_FILES['new_avatar']['name']);
                $target_dir = "assets/uploads/";
                $target_file = $target_dir . $avatar;
                $is_file_uploaded = move_uploaded_file($_FILES["new_avatar"]["tmp_name"], $target_file);
                $new_avatar_path = $target_dir. $avatar;

                // Read file, find the account by username, access and take the string vat path to replace.
                if (file_exists('./assets/storage/accounts.db')) {
                    $account_file = fopen('./assets/storage/accounts.db', 'r');
                    if ($account_file) {
                        // Read the file line by line
                        $script = "";
                        while (($account = fgets($account_file)) !== false) {
                            $account_details = explode('|', $account);
                            if (trim($_SESSION['user']['username']) == trim($account_details[1])) {
                                $old_avatar_path = $account_details[3];
                                $account = str_replace($old_avatar_path, $new_avatar_path, $account);
              
                            };
                            $script .= $account;
                        }               
                        fclose($account_file);
                    }
                }

                $account_file = fopen( 'accounts.db', 'w' );
                fwrite($account_file, $script);
                fclose($account_file);
                header("Refresh:0");
            }
        }
    };
?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lazada</title>

    <!-- Font families -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Hachi+Maru+Pop&family=Hubballi&family=Inter:wght@300;400;500;600;700;800&family=Kalam:wght@700&family=Montserrat:wght@254&family=Open+Sans:wght@326;379&family=Permanent+Marker&family=Poppins:wght@100&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,700&family=Rubik+Glitch&display=swap');
    </style>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/base.css">
    <!-- <link rel="stylesheet" href="assets/css/registration_pages.css"> -->
    <link rel="stylesheet" href="assets/css/biography.css">
</head>
<body>
    <!-- Header section -->
    <header>
        <div class="brand">
            <img src="assets/img/logo.png" alt="" class="brand__logo">
            <p class="brand__text">Zalada</p>
        </div>
        <nav>
            <ul class="nav_pc_container">
                <li class="nav_pc_item">
                    <a href="#" class="nav_pc_item__link">About</a>
                </li>
                <li class="nav_pc_item">
                    <a href="#" class="nav_pc_item__link">Policies</a>
                </li>
                <li class="nav_pc_item">
                    <a href="#" class="nav_pc_item__link">Help</a>
                </li>
                <li class="nav_pc_item">
                    <a href="#" class="nav_pc_item__link">Contact</a>
                </li>
                <li class="nav_pc_item">
                    <img src="<?php echo $_SESSION['user']['avatar']?>" alt="" class="nav_pc_item__avt">
                    <ul class="account-setting-container hide">
                        <li class="account-setting-item">
                            <a href="my_account.php">My account</a>
                        </li>
                        <li class="account-setting-item">
                            <a href="./www/index.php">Log out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main content -->
    <main>
        <section class="biography">
            <div class="biography_content">
                <div class="biography_content_old">
                    <div class="biography_content__icon">
                        <i class="fa-solid fa-pen-to-square edit_profile_btn"></i>
                    </div>
                    <div class="biography_content__avatar">
                        <img src="<?php echo $_SESSION['user']['avatar']?>" alt="">
                    </div>
                    <h2 class="biography_content__username">Hi <?php echo ucfirst($_SESSION['user']['username']) ?></h2>

                    <ul class="biography_content__container">
                            <?php 
                                function display_biography_item($label, $info) {
                                    if ($label == "Role") {
                                        switch ($info) {
                                            case 'type1':
                                                $info = 'customer';
                                                break;
                                            case 'type2':
                                                $info = 'vendor';
                                                break;
                                            case 'type3':
                                                $info = 'shipper';
                                                break;
                                            default: 
                                                $info = "unset";
                                        }
                                    }
                                    echo '<li class="biography_content__item">
                                    <span class="biography_content__item__label">'. $label . ': </span>
                                    <span class="biography_content__item__info"> '.  ucfirst($info) .'</span> </li>';
                                }

                                switch ($_SESSION['user']['user_type']) {
                                    case 'type1':
                                        display_biography_item("Role", $_SESSION['user']['user_type']);
                                        display_biography_item("Full name", $_SESSION['user']['real_name']);
                                        display_biography_item("Address", ($_SESSION['user']['address']) ? $_SESSION['user']['address'] : "Unset");
                                        break;
                                    case 'type2':
                                        display_biography_item("Role", $_SESSION['user']['user_type']);
                                        display_biography_item("Business name", ($_SESSION['user']['business_name']) ? $_SESSION['user']['business_name'] : "Unset");
                                        display_biography_item("Business address", ($_SESSION['user']['business_address']) ? $_SESSION['user']['business_address'] : "Unset");
                                        break;        
                                    case 'type3':
                                        display_biography_item("Role", $_SESSION['user']['user_type']);
                                        display_biography_item("Full name", $_SESSION['user']['real_name']);
                                        display_biography_item("Distribution hub", $_SESSION['user']['distribution_hub']);
                                        break;
                                }
                            ?>
                        </ul>

                </div>
                <div class="biography_content_new">
                     <div class="biography_content__icon">
                        <i class="fa-solid fa-xmark cancel_edit_btn"></i>
                    </div>

                    <form action="" method="post" enctype="multipart/form-data" class="change_profile_form">
                        <div class="form_field avatar">
                            <label for="new_avatar" class="edit_btn form_field__label"> 
                                <img src="assets/img/mock_avt2.png" alt="" class="avt_block">
                                <i class="fa-solid fa-camera camera_icon"></i>
                            </label>
                            <input type="file" name="new_avatar" accept="image/*" id="new_avatar" onchange="loadFile(event)" style="display: none"> 
                            <span class="form_field__message"> 
                                <?php
                                    // echo isset($avt_err) ? $avt_err : '';
                                ?>
                            </span>
                        </div>

                        <!-- Khi ấn vào edit button:
                            + các input field sẽ hthị, còn các thtin đã hthị ban nãy sẽ bị display: none
                            + các input field sẽ có placeholder = php(echo $_SESSION['user'][...])-->
                        <div class="form_field">
                            <input type="submit" name="edit_profile_btn" id="edit_profile_btn" value="Update avatar" class="btn-hover color-9">
                        </div>
                    </form>
                    
                </div>
            </div>
        </section>        
    </main>
    
    
    <!-- JS CODE -->
    <!-- Upload image script -->
    <script src="./assets/js/preview.js"></script>

    <script>
        var changeProfileForm = document.querySelector('.change_profile_form');
        var oldBiography = document.querySelector('.biography_content_old');
        var editBtn = document.querySelector('.edit_profile_btn');
        var cancelBtn = document.querySelector('.cancel_edit_btn');

        function enableEdit() {
            changeProfileForm.classList.remove('hide');
            oldBiography.classList.add('hide');
            cancelBtn.classList.remove('hide');
        }

        function disableEdit() {
            changeProfileForm.classList.add('hide');
            oldBiography.classList.remove('hide');
            cancelBtn.classList.add('hide');
        }

        editBtn.addEventListener('click', enableEdit);
        cancelBtn.addEventListener('click', disableEdit);
        disableEdit();
    </script>
    

    <!-- JS CODE -->
    <script src="./assets/js/preview.js"></script>'
    <script>
        var avatarElement = document.querySelector('.nav_pc_item__avt');
        var accountSetting = document.querySelector('.account-setting-container');

        avatarElement.onclick = function() {
            if (accountSetting.classList.contains('hide')) {
                accountSetting.classList.remove('hide');
            } else {
                accountSetting.classList.add('hide');
            }
    }
    </script>   

    <!-- Validate Client side -->
    <script src='./assets/js/validator.js'></script>
    <script>
        var realName = document.getElementById('new_real_name');
        var avatar = document.getElementById('new_avatar');
        var gender = document.getElementById('new_gender');
        var nationality = document.getElementById('new_nationality');
        var editProfileButton = document.getElementById('edit_profile_btn');
        var formFieldArr = document.querySelectorAll('.form_field');

        function formValidation() {
            let isValidName = otherFieldValidation(realName);
            let isValidGender = checkSelect(gender);
            let isValidNationality = checkSelect(nationality);
            let isFileUploaded = false;

            if (!checkFileUpload(avatar)) {
                showError(avatar, 'Not uploaded')
            } else {
                isFileUploaded = true;
                showSuccess(avatar)
            }
            
            if (isValidName || isValidGender || isValidName || isValidNationality || isFileUploaded) {
                return true
            } 
            return false
        }

        // When click on submit button
        editProfileButton.addEventListener("click", function(event){
            let isValid =  formValidation()
            if (!isValid) {
                formFieldArr.forEach(formField => {
                    formField.style['padding-top'] = "10px";
                });
                event.preventDefault()
            }
        }); 

        cancelBtn.onclick = function() {
            changeProfileForm.reset();
            let formFieldMsgArr = document.querySelectorAll('.form_field__message');
            formFieldMsgArr.forEach(formFieldMsg => {
                formFieldMsg.innerText = "";
            })
        }

    </script>
</body>
</html>
<?php 
    ob_end_flush();
?>