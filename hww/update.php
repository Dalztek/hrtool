<?php
require_once('db.php');
require_once('user.php');

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userid = $_SESSION['user_id'];
$fet = new User($conn);
$fetres = $fet->fetrow($userid);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dp_name = $_FILES['udp']['name'];
    $dp_tmp_path = $_FILES['udp']['tmp_name'];
    $dp_storage_path = "user_profile/" . $dp_name;
    move_uploaded_file($dp_tmp_path, $dp_storage_path);

    $doc_name = $_FILES['udocument']['name'];
    $doc_tmp_path = $_FILES['udocument']['tmp_name'];
    $doc_storage_path = "user_document/" . $doc_name;
    move_uploaded_file($doc_tmp_path, $doc_storage_path);

    $uname = $_POST['uname'];
    $umiddleName = $_POST['umiddle_name'];
    $ulastName = $_POST['ulast_name'];
    $uprimaryContact = $_POST['uprimary_contact'];
    $usecondaryContact = $_POST['usecondary_contact'];
    $uemail = $_POST['uemail'];
    $upassword = $_POST['upassword'];
    $uconfirm_password = $_POST['uconfirm_password'];
    $udob = $_POST['udob'];
    $uaddress = $_POST['uaddress'];
    $ugender = $_POST['ugender'];
    $ustate = $_POST['ustate'];
    $ucity = $_POST['ucity'];
    $unationality = $_POST['unationality'];
    $uschool10thName = $_POST['uschool_10th_name'];
    $uschool10thMark = $_POST['uschool_10th_mark'];
    $uschool10thYear = $_POST['uschool_10th_year'];
    $uschool10thPercentage = $_POST['uschool_10th_percentage'];
    $uschool12thName = $_POST['uschool_12th_name'];
    $uschool12thMark = $_POST['uschool_12th_mark'];
    $uschool12thYear = $_POST['uschool_12th_year'];
    $uschool12thPercentage = $_POST['uschool_12th_percentage'];
    $ucollegeName = $_POST['ucollege_name'];
    $uuniversityName = $_POST['uuniversity_name'];
    $ugraduationCGPA = $_POST['ugraduation_cgpa'];
    $ugraduationPercentage = $_POST['ugraduation_percentage'];
    $ugraduationYear = $_POST['ugraduation_year'];
    $ustream = $_POST['ustream'];
    $uexperience = $_POST['uexperience'];
    $uskills = $_POST['uskills'];
    $ucertifications = $_POST['ucertifications'];
    $ulanguages = $_POST['ulanguages'];
    $ubacklog = $_POST['ubacklog'];
    $id =$_SESSION['user_id'];
    $user = new User($conn);
    $user->aupdatead(
        $uname, $umiddleName, $ulastName, $uprimaryContact, $usecondaryContact, $uemail, $upassword,
        $uconfirm_password, $dp_storage_path, $doc_storage_path, $udob, $uaddress, $ugender, $ustate,
        $ucity, $unationality, $uschool10thName, $uschool10thMark, $uschool10thYear, $uschool10thPercentage,
        $uschool12thName, $uschool12thMark, $uschool12thYear, $uschool12thPercentage, $ucollegeName,
        $uuniversityName, $ugraduationCGPA, $ugraduationPercentage, $ugraduationYear, $ustream, $uexperience,
        $uskills, $ucertifications, $ulanguages, $ubacklog ,$id
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Update User Registration</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <!-- Personal Information -->
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control" name="uname" value="<?php echo $fetres['name']  ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Middle Name:</label>
                        <input type="text" class="form-control" name="umiddle_name" value="<?php   ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name:</label>
                        <input type="text" class="form-control" name="ulast_name" value="<?php  ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Primary Contact:</label>
                        <input type="text" class="form-control" name="uprimary_contact" value="<?php  ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Secondary Contact:</label>
                        <input type="text" class="form-control" name="usecondary_contact" value="<?php   ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="uemail" value="<?php   ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password:</label>
                        <input type="password" class="form-control" name="upassword" >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" name="uconfirm_password" >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date of Birth:</label>
                        <input type="date" class="form-control" name="udob" value="<?php  ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address:</label>
                        <textarea class="form-control" name="uaddress"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender:</label>
                        <select class="form-control" name="ugender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    
                        <div class="mb-3">
                            <label class="form-label">State:</label>
                            <input type="text" class="form-control" name="ustate" value="<?php   ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">City:</label>
                            <input type="text" class="form-control" name="ucity" value="<?php  ?>" required>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Nationality:</label>
                            <input type="text" class="form-control" name="unationality" value="<?php   ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">10th School Name:</label>
                            <input type="text" class="form-control" name="uschool_10th_name" value="<?php   ?>"required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">10th Mark:</label>
                            <input type="text" class="form-control" name="uschool_10th_mark" value="<?php   ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">10th Completion Year:</label>
                            <input type="text" class="form-control" name="uschool_10th_year" value="<?php   ?>" required>
                        </div>

                       
                        <div class="mb-3">
                            <label class="form-label">10th Percentage:</label>
                            <input type="text" class="form-control" name="uschool_10th_percentage" value="<?php  ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">12th School Name:</label>
                            <input type="text" class="form-control" name="uschool_12th_name" value="<?php    ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">12th Mark:</label>
                            <input type="text" class="form-control" name="uschool_12th_mark" value="<?php  ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">12th Completion Year:</label>
                            <input type="text" class="form-control" name="uschool_12th_year" value="<?php   ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">12th Percentage:</label>
                            <input type="text" class="form-control" name="uschool_12th_percentage" value="<?php  ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">Graduation College Name:</label>
                            <input type="text" class="form-control" name="ucollege_name" value="<?php   ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">University Name:</label>
                            <input type="text" class="form-control" name="uuniversity_name" value="<?php    ?>"required>
                        </div>

                       
                        <div class="mb-3">
                            <label class="form-label">CGPA:</label>
                            <input type="text" class="form-control" name="ugraduation_cgpa" value="<?php  ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Percentage:</label>
                            <input type="text" class="form-control" name="ugraduation_percentage" value="<?php  ?>"required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">Graduation Completion Year:</label>
                            <input type="text" class="form-control" name="ugraduation_year" value="<?php   ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">Stream:</label>
                            <input type="text" class="form-control" name="ustream" value="<?php   ?>"required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">Experience or Fresher:</label>
                            <input type="text" class="form-control" name="uexperience" value="<?php  ?>" required>
                        </div>

                       
                        <div class="mb-3">
                            <label class="form-label">Skills:</label>
                            <input type="text" class="form-control" name="uskills" value="<?php  ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Certifications:</label>
                            <input type="text" class="form-control" name="ucertifications" value="<?php  ?>" >
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Languages:</label>
                            <input type="text" class="form-control" name="ulanguages" value="<?php   ?>">
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Backlog:</label>
                            <input type="text" class="form-control" name="ubacklog" value="<?php   ?>"required>
                        </div>


                    <div class="mb-3">
                        <label class="form-label">Profile Photo:</label>
                        <input type="file" class="form-control" name="udp" accept="image/*" >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Document:</label>
                        <input type="file" class="form-control" name="udocument" accept=".pdf, .doc, .docx" >
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                </form>
            </div>

            <div class="row mt-3">
            <div class="col-md-12">
                <a href="dahboard.php" class="btn btn-danger">Go to Dashboard</a>
            </div>
        </div>
        </div>
    </div>
</body>
</html>

