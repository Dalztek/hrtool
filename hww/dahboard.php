<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


// select and display the values in user register table
require_once('user.php');
$userid = $_SESSION['user_id'];
$select_values = "SELECT * FROM user_reg WHERE user_id = $userid";
$adminlogins = mysqli_query($conn, $select_values);
$num_of_rows = mysqli_num_rows($adminlogins);
if ($num_of_rows == 1) {
    $fetch_row = mysqli_fetch_assoc($adminlogins);
} else {
    header('Location: login.php');
    exit();
}



// delete  profile
if (isset($_POST['userpro'])) {
    $delus = $_POST['admindel'];
    $user = new User($conn);
    $user->dels($delus);
}



// show hr job notifiation
require_once('dohr.php');
$dohr = new Hr($conn);
$hrsel2 = $dohr->hrtable();


// use the data in update input value attribute
$user = new User($conn);
$fetres = $user->fetrow($userid);


// update other values
if (isset($_POST['upsubmit'])) {
    $uname = $_POST['uname'];
    $ulastName = $_POST['ulast_name'];
    $uprimaryContact = $_POST['uprimary_contact'];
    $usecondaryContact = $_POST['usecondary_contact'];
    $uemail = $_POST['uemail'];
    $udob = $_POST['udob'];
    $uaddress = $_POST['uaddress'];
    $ugender = $_POST['ugender'];
    $ustate = $_POST['ustate'];
    $ucity = $_POST['ucity'];
    $unationality = $_POST['unationality'];
    $uschool10thName = $_POST['uschool_10th_name'];
    $uschool10thYear = $_POST['uschool_10th_year'];
    $uschool10thPercentage = $_POST['uschool_10th_percentage'];
    $uschool12thName = $_POST['uschool_12th_name'];
    $uschool12thYear = $_POST['uschool_12th_year'];
    $uschool12thPercentage = $_POST['uschool_12th_percentage'];
    $ucollegeName = $_POST['ucollege_name'];
    $uuniversityName = $_POST['uuniversity_name'];
    $ugraduationPercentage = $_POST['ugraduation_percentage'];
    $ugraduationYear = $_POST['ugraduation_year'];
    $ustream = $_POST['ustream'];
    $uexperience = $_POST['uexperience'];
    $uskills = $_POST['uskills'];
    $ucertifications = $_POST['ucertifications'];
    $ulanguages = $_POST['ulanguages'];
    $ubacklog = $_POST['ubacklog'];
    $noofexp12 = $_POST['noofexp12'];
    $id =$_SESSION['user_id'];

    $user = new User($conn);
    $user->aupdatead(
        $uname, $ulastName, $uprimaryContact, $usecondaryContact, $uemail, $udob, $uaddress, $ugender, $ustate,$ucity, $unationality, $uschool10thName, $uschool10thYear, $uschool10thPercentage,
            $uschool12thName, $uschool12thYear, $uschool12thPercentage, $ucollegeName,
            $uuniversityName, $ugraduationPercentage, $ugraduationYear, $ustream, $uexperience,
            $uskills, $ucertifications, $ulanguages, $ubacklog ,$id, $noofexp12
        );
    }



// update password
if(isset($_POST['cp'])){
    $id1 = $_SESSION['user_id'];
    $upassword = $_POST['upassword'];
    $uconfirm_password = $_POST['uconfirm_password'];
    if ($upassword == $uconfirm_password) {
        $user = new User($conn);
        $user->aupdatead1($upassword, $uconfirm_password, $id1);
    } else {
        echo "Please enter the same password";
    }
}

// update photo
if(isset($_POST['up'])){
    $id2 = $_SESSION['user_id'];
    $dp_name = $_FILES['udp']['name'];
    $dp_tmp_path = $_FILES['udp']['tmp_name'];
    $dp_storage_path = "user_profile/" . $dp_name;
    move_uploaded_file($dp_tmp_path, $dp_storage_path);
    $user = new User($conn);
    $user->aupdatead2($dp_storage_path, $id2);
}

// update resume
// if(isset($_POST['cd'])){
//     $id3 = $_SESSION['user_id'];
//     $doc_name = $_FILES['udocument']['name'];
//     $doc_tmp_path = $_FILES['udocument']['tmp_name'];
//     $doc_storage_path = "user_document/" . $doc_name;
//     move_uploaded_file($doc_tmp_path, $doc_storage_path);
//     $user = new User($conn);
//     $user->aupdatead3($doc_storage_path, $id3);
// }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, <?php echo $fetch_row['name']; ?> <?php echo $fetch_row['last_name']; ?>  !</h2>
        <div class="row mt-3">
            <div class="col-md-6">
                <p><strong>Email:</strong> <?php echo $fetch_row['email'] ; ?></p>
                <p><strong>Primary Contact:</strong> <?php echo $fetch_row['primary_contact']; ?></p>
                <p><strong>Secondary Contact:</strong> <?php echo $fetch_row['secondary_contact']; ?></p>
                <p><strong>Date of Birth:</strong> <?php echo $fetch_row['dob']; ?></p>
                <p><strong>Address:</strong> <?php echo $fetch_row['address']; ?></p>
                <p><strong>Gender:</strong> <?php echo $fetch_row['gender']; ?></p>
                <p><strong>State:</strong> <?php echo $fetch_row['state']; ?></p>
                <p><strong>City:</strong> <?php echo $fetch_row['city']; ?></p>
                <p><strong>Nationality:</strong> <?php echo $fetch_row['nationality']; ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>10th School Name:</strong> <?php echo $fetch_row['school_10th_name']; ?></p>
                <p><strong>10th Completion Year:</strong> <?php echo $fetch_row['school_10th_year']; ?></p>
                <p><strong>10th Percentage:</strong> <?php echo $fetch_row['school_10th_percentage']; ?></p>
                <p><strong>12th School Name:</strong> <?php echo $fetch_row['school_12th_name']; ?></p>
                <p><strong>12th Completion Year:</strong> <?php echo $fetch_row['school_12th_year']; ?></p>
                <p><strong>12th Percentage:</strong> <?php echo $fetch_row['school_12th_percentage']; ?></p>
                <p><strong>Graduation College Name:</strong> <?php echo $fetch_row['college_name']; ?></p>
                <p><strong>University Name:</strong> <?php echo $fetch_row['university_name']; ?></p>
                <p><strong>Percentage:</strong> <?php echo $fetch_row['graduation_percentage']; ?></p>
                <p><strong>Graduation Completion Year:</strong> <?php echo $fetch_row['graduation_year']; ?></p>
                <p><strong>Stream:</strong> <?php echo $fetch_row['stream']; ?></p>
                <p><strong>Experience or Fresher:</strong> <?php echo $fetch_row['experience']; ?></p>
                <p><strong>No.of Experience:</strong> <?php echo $fetch_row['no_of_expe']; ?></p>
                <p><strong>Skills:</strong> <?php echo $fetch_row['skills']; ?></p>
                <p><strong>Certifications:</strong> <?php echo $fetch_row['certifications']; ?></p>
                <p><strong>Languages:</strong> <?php echo $fetch_row['languages']; ?></p>
                <p><strong>Backlog:</strong> <?php echo $fetch_row['backlog']; ?></p>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-md-6">
                <img src="<?php echo $fetch_row['dp_storage_path']; ?>" alt="Profile Photo"  class="img-fluid" style="width: 200px; height: 200px;">
            </div>
        </div>



<div class="container">
    <div class="row">
        <?php
        $cardCounter = 0;
        while ($row = $hrsel2->fetch_assoc()) {
            if ($cardCounter % 4 == 0) {
                if ($cardCounter > 0) {
                    echo '</div></div>';
                }
                echo '<div class="container"><div class="row">';
            }
            ?>

    
            <div class="col-md-4 p-3">
                <div class="card shadow-lg">
                    <h1>head</h1>
                    <div class="card-body">
                        <h2>JOBS</h2>
                        <span class="d-flex">
                            <p class="me-4">job ID: </p> <p><?php $_SESSION['job_noti_ida'] = $row['job_noti_id']; echo $row['job_noti_id']; ?></p>
                        </span>
                        <span class="d-flex">
                            <p class="me-4">job title: </p> <p><?php echo $row['job_title']; ?></p>
                        </span>
                        <span class="d-flex">
                            <p class="me-4">openings: </p> <p><?php echo $row['openings']; ?></p>
                        </span>
                        <span class="d-flex">
                            <p class="me-4">experience: </p> <p><?php echo $row['experience']; ?></p>
                        </span>
                        <span class="d-flex">
                            <p class="me-4">no.of experience: </p> <p><?php echo $row['no_of_exp']; ?></p>
                        </span>
                        <span class="d-flex">
                            <p class="me-4">description: </p> <p><?php echo $row['description']; ?></p>
                        </span>
                        <span class="d-flex">
                            <p class="me-4">location: </p> <p><?php echo $row['location']; ?></p>
                        </span>
                        <span class="d-flex">
                            <p class="me-4">application start time: </p> <p><?php echo $row['app_start_date']; ?></p>
                        </span>
                        <span class="d-flex">
                            <p class="me-4">application end time: </p> <p><?php echo $row['app_end_date']; ?></p>
                        </span>
                        <div class="">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $cardCounter; ?>">
                                APPLY
                            </button>
                            <div class="modal fade" id="myModal<?php echo $cardCounter; ?>">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Modal Heading</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                    <?php
                    if ($fetch_row['experience'] == $row['experience'] && $fetch_row['no_of_expe'] <= $row['no_of_exp']) {
                                    ?>
                                   
                            <h4>Welcome, <?php echo $fetch_row['name']; ?> <?php echo $fetch_row['last_name']; ?>  !</h4>
                            <p><strong>Primary Contact:</strong> <?php echo $fetch_row['primary_contact']; ?></p>
                            <p><strong>Date of Birth:</strong> <?php echo $fetch_row['dob']; ?></p>
                            <p><strong>Experience or Fresher:</strong> <?php echo $fetch_row['experience']; ?></p>
                            <p><strong>No.of Experience:</strong> <?php echo $fetch_row['no_of_expe']; ?></p>
                            <p class="me-4"> <strong> job title:</strong>  <?php echo $row['job_title']; ?></p>


                                        <form method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="experience" class="form-label">Relevant Experience</label>
                                    <input type="text" class="form-control" id="experience" name="experience">
                                </div>

                                <div class="mb-3">
                                    <label for="previousSalary" class="form-label">Previous Salary</label>
                                    <input type="text" class="form-control" id="previousSalary" name="previousSalary">
                                </div>

                                <div class="mb-3">
                                    <label for="expectedSalary" class="form-label">Expected Salary</label>
                                    <input type="text" class="form-control" id="expectedSalary" name="expectedSalary">
                                </div>

                                <div class="mb-3">
                                    <label for="resume" class="form-label">Resume</label>
                                    <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx">
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <input type="text" class="form-select" id="status" name="status">
                                </div>

                                <div class="mb-3">
                                    <label for="noticePeriod" class="form-label">Notice Period</label>
                                    <input type="text" class="form-control" id="noticePeriod" name="noticePeriod">
                                </div>
                                <input type="hidden" name="noid" value="<?php echo $row['job_noti_id']; ?>">
                                <button type="submit" name="apply" class="btn btn-primary">Submit</button>
                            </form>

                                    <?php
                                        } 
                                        else {
                                         echo '<p>User does not meet the requirements to apply for this job</p>';
                                        }
                                    ?>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $cardCounter++;
        }
        echo '</div></div>';
                 
        // APPLICATION INSERT (app_table)
        if (isset($_POST['apply'])) {
            $experience = $_POST['experience'];
            $previousSalary = $_POST['previousSalary'];
            $expectedSalary = $_POST['expectedSalary'];
            $dp_name = $_FILES['resume']['name'];
            $dp_tmp_path = $_FILES['resume']['tmp_name'];
            $dp_storage_path1 = "user_resume/" . $dp_name;
            move_uploaded_file($dp_tmp_path, $dp_storage_path1);
            $status = $_POST['status'];
            $noticePeriod = $_POST['noticePeriod'];
            $userid = $fetch_row['user_id'];
            $notiid = $_POST['noid'];
            
            $user->insertapplication($userid, $notiid, $experience, $previousSalary, $expectedSalary, $dp_storage_path1, $status, $noticePeriod);
        }
    
        ?>
    </div>
</div>








<div class="row mt-3">
    <div class="col-md-12">
        <form method="post">
            <div class="text-center">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal1">
                    UPDATE
                </button>
                <div class="modal fade" id="myModal1">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-primary">UPDATE PROFILE</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">

                                <!-- Personal Information -->
                                <div class="mb-3">
                                    <label class="form-label">Name:</label>
                                    <input type="text" class="form-control" name="uname" value="<?php echo $fetres['name']; ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Last Name:</label>
                                    <input type="text" class="form-control" name="ulast_name" value="<?php echo $fetres['last_name']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Primary Contact:</label>
                                    <input type="text" class="form-control" name="uprimary_contact" value="<?php echo $fetres['primary_contact']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Secondary Contact:</label>
                                    <input type="text" class="form-control" name="usecondary_contact" value="<?php echo $fetres['secondary_contact']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="uemail" value="<?php echo $fetres['email']; ?>" required>
                                </div>

                                <!-- Additional Personal Information -->
                                <div class="mb-3">
                                    <label class="form-label">Date of Birth:</label>
                                    <input type="date" class="form-control" name="udob" value="<?php echo $fetres['dob']; ?>">
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
                                    <input type="text" class="form-control" name="ustate" value="<?php echo $fetres['state']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">City:</label>
                                    <input type="text" class="form-control" name="ucity" value="<?php echo $fetres['city']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nationality:</label>
                                    <input type="text" class="form-control" name="unationality" value="<?php echo $fetres['nationality']; ?>" required>
                                </div>

                                <!-- Educational Information -->
                                <!-- 10th Details -->
                                <div class="mb-3">
                                    <label class="form-label">10th School Name:</label>
                                    <input type="text" class="form-control" name="uschool_10th_name" value="<?php echo $fetres['school_10th_name']; ?>" required>
                                </div>
                            
                                <div class="mb-3">
                                    <label class="form-label">10th Completion Year:</label>
                                    <input type="text" class="form-control" name="uschool_10th_year" value="<?php echo $fetres['school_10th_year']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">10th Percentage:</label>
                                    <input type="text" class="form-control" name="uschool_10th_percentage" value="<?php echo $fetres['school_10th_percentage']; ?>" required>
                                </div>

                                <!-- 12th Details -->
                                <div class="mb-3">
                                    <label class="form-label">12th School Name:</label>
                                    <input type="text" class="form-control" name="uschool_12th_name" value="<?php echo $fetres['school_12th_name']; ?>" required>
                                </div>
                               
                                <div class="mb-3">
                                    <label class="form-label">12th Completion Year:</label>
                                    <input type="text" class="form-control" name="uschool_12th_year" value="<?php echo $fetres['school_12th_year']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">12th Percentage:</label>
                                    <input type="text" class="form-control" name="uschool_12th_percentage" value="<?php echo $fetres['school_12th_percentage']; ?>" required>
                                </div>

                                <!-- Graduation Details -->
                                <div class="mb-3">
                                    <label class="form-label">Graduation College Name:</label>
                                    <input type="text" class="form-control" name="ucollege_name" value="<?php echo $fetres['college_name']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">University Name:</label>
                                    <input type="text" class="form-control" name="uuniversity_name" value="<?php echo $fetres['university_name']; ?>" required>
                                </div>
                               
                                <div class="mb-3">
                                    <label class="form-label">Percentage:</label>
                                    <input type="text" class="form-control" name="ugraduation_percentage" value="<?php echo $fetres['graduation_percentage']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Graduation Completion Year:</label>
                                    <input type="text" class="form-control" name="ugraduation_year" value="<?php echo $fetres['graduation_year']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Stream:</label>
                                    <input type="text" class="form-control" name="ustream" value="<?php echo $fetres['stream']; ?>" required>
                                </div>

                                <!-- Experience Information -->
                                <div class="form-group">
                                    <label for="experience">Experience or Fresher</label>
                                    <select class="form-control" id="experience" name="uexperience" required>
                                        <option value="experience">Experience</option>
                                        <option value="fresher">Fresher</option>
                                    </select>
                                </div>
                                <div class="form-group" id="experienceYearsGroup" style="display: none;">
                                    <label for="experienceYears">Number of Years of Experience</label>
                                    <input type="number" class="form-control" id="experienceYears" name="noofexp12" placeholder="Enter years of experience">
                                </div>

                                <!-- Additional Skills and Certifications -->
                                <div class="mb-3">
                                    <label class="form-label">Skills:</label>
                                    <input type="text" class="form-control" name="uskills" value="<?php echo $fetres['skills']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Certifications:</label>
                                    <input type="text" class="form-control" name="ucertifications" value="<?php echo $fetres['certifications']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Languages:</label>
                                    <input type="text" class="form-control" name="ulanguages" value="<?php echo $fetres['languages']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Backlog:</label>
                                    <input type="text" class="form-control" name="ubacklog" value="<?php echo $fetres['backlog']; ?>" required>
                                </div>

                                <!-- JavaScript for Experience Dropdown -->
                                <script>
                                    document.getElementById('experience').addEventListener('change', function () {
                                        var experienceYearsGroup = document.getElementById('experienceYearsGroup');
                                        if (this.value === 'experience') {
                                            experienceYearsGroup.style.display = 'block';
                                        } else {
                                            experienceYearsGroup.style.display = 'none';
                                        }
                                    });
                                </script>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="upsubmit" class="btn btn-warning" data-bs-dismiss="modal">Update Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>




            <div class="text-center">
                <div class="mt-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal4">
                        Change Password
                    </button>
                </div>
                <div class="modal fade" id="myModal4">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Change Password</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <div class="mb-3">
                                        <label class="form-label">Password:</label>
                                        <input type="password" class="form-control" name="upassword" >
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password:</label>
                                        <input type="password" class="form-control" name="uconfirm_password">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="cp" class="btn btn-success" data-bs-dismiss="modal">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal5">
                        Update Photo
                    </button>
                </div>
                <div class="modal fade" id="myModal5">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Update Photo</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">Profile Photo:</label>
                                        <input type="file" class="form-control" name="udp" accept="image/*">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="up" class="btn btn-success" data-bs-dismiss="modal">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="mt-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal6">
                        Update Resume
                    </button>
                </div>
                <div class="modal fade" id="myModal6">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Change Resume</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">Document:</label>
                                        <input type="file" class="form-control" name="udocument" accept=".pdf, .doc, .docx">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="cd" class="btn btn-success" data-bs-dismiss="modal">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->




        <div class="row mt-3">
            <div class="col-md-12">
            <form method="post" action="dahboard.php">
                <input type="hidden" name="admindel" value="<?php echo $_SESSION['user_id']; ?>">
                <div class="text-center">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal">
                        REMOVE
                    </button>
                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-primary">
                                        <h2>Welcome, <?php echo $fetch_row['name']; ?> <?php echo $fetch_row['last_name']; ?>  !</h2>
                                    </h4>
                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                                </div>
                                <div class="modal-body text-center">
                                    <h5 class="text-danger">Do you want to remove your account....</h5>
                                    <button type="submit" name="userpro" class="btn btn-warning">REMOVE PROFILE</button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
