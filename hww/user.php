<?php
class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($name, $lastName, $primaryContact, $secondaryContact, $email, $password,
                            $confirm_password, $dp_storage_path, $dob, $address, $gender, $state,
                            $city, $nationality, $school10thName, $school10thYear, $school10thPercentage,
                            $school12thName, $school12thYear, $school12thPercentage, $collegeName,
                            $universityName, $graduationPercentage, $graduationYear, $stream, $experience,
                            $skills, $certifications, $languages, $backlog, $noofexp) {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insert_value = "INSERT INTO user_reg (name, last_name, primary_contact, secondary_contact, email, password,confirm_password, dp_storage_path, dob, address, gender, state,city, nationality, school_10th_name, school_10th_year, school_10th_percentage,school_12th_name, school_12th_year, school_12th_percentage, college_name,university_name, graduation_percentage, graduation_year, stream, experience,skills, certifications, languages, backlog, no_of_expe)
        VALUES ('$name','$lastName', '$primaryContact', '$secondaryContact', '$email', '".md5($password)."',
            '".md5($confirm_password)."', '$dp_storage_path','$dob', '$address', '$gender', '$state',
            '$city', '$nationality', '$school10thName', '$school10thYear', '$school10thPercentage',
            '$school12thName','$school12thYear', '$school12thPercentage', '$collegeName',
            '$universityName', '$graduationPercentage', '$graduationYear', '$stream', '$experience',
            '$skills', '$certifications', '$languages', '$backlog', '$noofexp')";
        $connect_q = $this->conn->query($insert_value);
        
    }


    public function login($email, $password) {
        $select_value = "SELECT * FROM user_reg WHERE email='$email' AND password='" . md5($password) . "'";
        $adminlogin = mysqli_query($this->conn, $select_value);

        $num_of_rows = mysqli_num_rows($adminlogin);
        if ($num_of_rows == 1) {
            $fetch_rows = $adminlogin->fetch_assoc();
            $_SESSION['user_id'] = $fetch_rows['user_id'];
            return $fetch_rows;
        } else {
            return false;
        }
    }

    public function aupdatead($uname, $ulastName, $uprimaryContact, $usecondaryContact, $uemail,$udob, $uaddress, $ugender, $ustate,$ucity, $unationality, $uschool10thName,$uschool10thYear, $uschool10thPercentage,$uschool12thName, $uschool12thYear, $uschool12thPercentage, $ucollegeName,$uuniversityName,  $ugraduationPercentage,              $ugraduationYear, $ustream, $uexperience,$uskills, $ucertifications, $ulanguages, $ubacklog ,$id,              $noofexp12) {

        $upsql = "UPDATE user_reg SET 
                        name='$uname', 
                        last_name='$ulastName', 
                        primary_contact='$uprimaryContact', 
                        secondary_contact='$usecondaryContact', 
                        email='$uemail', 
                        dob='$udob', 
                        address='$uaddress', 
                        gender='$ugender', 
                        state='$ustate',
                        city='$ucity', 
                        nationality='$unationality', 
                        school_10th_name='$uschool10thName', 
                        school_10th_year='$uschool10thYear', 
                        school_10th_percentage='$uschool10thPercentage', 
                        school_12th_name='$uschool12thName', 
                        school_12th_year='$uschool12thYear', 
                        school_12th_percentage='$uschool12thPercentage', 
                        college_name='$ucollegeName', 
                        university_name='$uuniversityName', 
                        graduation_percentage='$ugraduationPercentage', 
                        graduation_year='$ugraduationYear', 
                        stream='$ustream', 
                        experience='$uexperience', 
                        skills='$uskills', 
                        certifications='$ucertifications', 
                        languages='$ulanguages', 
                        backlog='$ubacklog',
                        no_of_expe ='$noofexp12'
                        WHERE user_id='$id'";
        if ($aa = mysqli_query($this->conn, $upsql)=== TRUE) {
                header('Location: dahboard.php');
            } else {
                echo "Error creating database: " . $this->conn->error;
            }

        }


        public function aupdatead1($upassword, $uconfirm_password, $id1){
            $upsql1 = "UPDATE user_reg SET 
                    password='".md5($upassword)."', 
                    confirm_password='".md5($uconfirm_password)."' 
                    WHERE user_id='$id1'";
            if ($aa1 = mysqli_query($this->conn, $upsql1) === TRUE) {
                header('Location: dahboard.php');
            } else {
                echo "Error updating password: " . $this->conn->error;
            }
        }

        public function aupdatead2($dp_storage_path, $id2){
            $upsql2 = "UPDATE user_reg SET 
                    dp_storage_path='$dp_storage_path'
                    WHERE user_id='$id2'";
            if ($aa2 = mysqli_query($this->conn, $upsql2) === TRUE) {
                header('Location: dahboard.php');
            } else {
                echo "Error updating photo: " . $this->conn->error;
            }
        }

        // public function aupdatead3($doc_storage_path, $id3){
        //     $upsql3 = "UPDATE user_reg SET 
        //             doc_storage_path='$doc_storage_path'
        //             WHERE user_id='$id3'";
        //     if ($aa3 = mysqli_query($this->conn, $upsql3) === TRUE) {
        //         header('Location: dahboard.php');
        //     } else {
        //         echo "Error updating document: " . $this->conn->error;
        //     }
        // }


    public function dels($delus) {
        $delsql = "DELETE FROM user_reg WHERE user_id ='$delus'";
        $del= $this->conn->query($delsql);
        if ($del) {
          header('Location: register.php');  
        }
    }

    public function fetrow($userid){
        $select_values = "SELECT * FROM user_reg WHERE user_id = '$userid'";
        $adminlogins = mysqli_query($this->conn, $select_values);
        $num_of_rows = mysqli_num_rows($adminlogins);
        if ($num_of_rows == 1) {
            return $fetch_row1 = mysqli_fetch_assoc($adminlogins);
        } else {
            header('Location: login.php');
            exit();
        }
    }

public function insertapplication($userid, $notiid, $experience, $previousSalary, $expectedSalary, $dp_storage_path1, $status, $noticePeriod) {
    $query = "INSERT INTO app_table (auser_id, ajob_noti_id, arelevent_experience, pre_salary, expected_salary, aresume, astatus, anotice_period) 
              VALUES ('$userid', '$notiid', '$experience', '$previousSalary', '$expectedSalary', '$dp_storage_path1', '$status', '$noticePeriod')";
    $co = $this->conn->query($query);
    
    if ($co) {
        // header("Location:dahboard.php");
        // echo "Record inserted successfully!";
    } else {
        echo "Error: " . $query . "<br>" . $this->conn->error;
    }
}


}
?>
