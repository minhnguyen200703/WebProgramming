<?php 
    if(isset($_POST['submit_btn']) && $_POST['submit_btn']) {
        
        // Upload avatar to directory "uploads"
        $target_dir = "./assets/avatars/";
        $target_file = $target_dir . $avatar;
        $is_file_uploaded = move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
        $avatar_path = $target_dir. $avatar;
        // Write to CSV file
        switch ($user_type) {
            case 'type1':
                $text = $user_type . "|" . $username . "|" . $_SESSION['hashed_password'] ."|" . $avatar_path . "|" . $real_name . "|" . $address . "|" . "\n";
                break;
            case 'type2':
                $text = $user_type . "|" . $username . "|" . $_SESSION['hashed_password'] ."|" . $avatar_path . "|" . $business_name . "|" . $business_address . "|" . "\n";
                break;
            case 'type3':
                $text = $user_type . "|" . $username . "|" . $_SESSION['hashed_password'] ."|" . $avatar_path . "|" . $real_name . "|" . $distribution_hub . "|" . "\n";
                break;
        }
        
        $is_written = false;
        $fp = fopen('./assets/storage/accounts.db', 'a+');
        if (fwrite($fp, $text)) {
            $is_written = true;
        };
        fclose ($fp);

        // Validate at server side again
        // if ($avatar_path && $username && $password && $real_name && $address && $is_file_uploaded $is_written) {
        //     header("Location: login.php"); 
        //     exit();
        // }
    }
?>