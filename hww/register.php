<?php
require_once('db.php');
require_once('user.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    // $middleName = $_POST['middle_name'];
    $lastName = $_POST['last_name'];
    $primaryContact = $_POST['primary_contact'];
    $secondaryContact = $_POST['secondary_contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $nationality = $_POST['nationality'];
    $school10thName = $_POST['school_10th_name'];
    // $school10thMark = $_POST['school_10th_mark'];
    $school10thYear = $_POST['school_10th_year'];
    $school10thPercentage = $_POST['school_10th_percentage'];
    $school12thName = $_POST['school_12th_name'];
    // $school12thMark = $_POST['school_12th_mark'];
    $school12thYear = $_POST['school_12th_year'];
    $school12thPercentage = $_POST['school_12th_percentage'];
    $collegeName = $_POST['college_name'];
    $universityName = $_POST['university_name'];
    // $graduationCGPA = $_POST['graduation_cgpa'];
    $graduationPercentage = $_POST['graduation_percentage'];
    $graduationYear = $_POST['graduation_year'];
    $stream = $_POST['stream'];
    $experience = $_POST['experience'];
    $skills = $_POST['skills'];
    $certifications = $_POST['certifications'];
    $languages = $_POST['languages'];
    $backlog = $_POST['backlog'];
    $noofexp = $_POST['noofexp'];

    if ($password == $confirm_password) {
        if (isset($_FILES['dp']) && $_FILES['dp']['error'] === UPLOAD_ERR_OK) {
            $dp_name = $_FILES['dp']['name'];
            $dp_tmp_path = $_FILES['dp']['tmp_name'];
            $dp_storage_path = "user_profile/" . $dp_name;

            if (move_uploaded_file($dp_tmp_path, $dp_storage_path)) {
                // if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
                    // $doc_name = $_FILES['document']['name'];
                    // $doc_tmp_path = $_FILES['document']['tmp_name'];
                    // $doc_storage_path = "user_document/" . $doc_name;

                    // if (move_uploaded_file($doc_tmp_path, $doc_storage_path)) {
                        $user = new User($conn);
                        $user->register(
                            $name, $lastName, $primaryContact, $secondaryContact, $email, $password,
                            $confirm_password, $dp_storage_path, $dob, $address, $gender, $state,
                            $city, $nationality, $school10thName, $school10thYear, $school10thPercentage,
                            $school12thName, $school12thYear, $school12thPercentage, $collegeName,
                            $universityName, $graduationPercentage, $graduationYear, $stream, $experience,
                            $skills, $certifications, $languages, $backlog, $noofexp
                        );

                        header('Location: login.php');
                        exit();

                    // } else {
                    //     echo "Error uploading document.";
                    // }
                // } else {
                //     echo "Please upload a valid document.";
                // }
            } else {
                echo "Error uploading profile photo.";
            }
        } else {
            echo "Please upload a valid profile photo.";
        }
    } else {
        echo "Passwords do not match.";
    }
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
                <h2 class="text-center">User Registration</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="register.php" enctype="multipart/form-data">
                    <!-- Personal Information -->
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <!-- <div class="mb-3">
                        <label class="form-label">Middle Name:</label>
                        <input type="text" class="form-control" name="middle_name">
                    </div> -->

                    <div class="mb-3">
                        <label class="form-label">Last Name:</label>
                        <input type="text" class="form-control" name="last_name">
                    </div>

                   
                    <div class="mb-3">
                        <label class="form-label">Primary Contact:</label>
                        <input type="text" class="form-control" name="primary_contact" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Secondary Contact:</label>
                        <input type="text" class="form-control" name="secondary_contact" >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>

                   
                    <div class="mb-3">
                        <label class="form-label">Date of Birth:</label>
                        <input type="date" class="form-control" name="dob" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address:</label>
                        <textarea class="form-control" name="address" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender:</label>
                        <select class="form-control" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                        <div class="mb-3">
                            <label class="form-label">State:</label>
                            <input type="text" class="form-control" name="state" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">City:</label>
                            <input type="text" class="form-control" name="city" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nationality:</label>
                            <input type="text" class="form-control" name="nationality" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">10th School Name:</label>
                            <input type="text" class="form-control" name="school_10th_name" required>
                        </div>

                        <!-- <div class="mb-3">
                            <label class="form-label">10th Mark:</label>
                            <input type="text" class="form-control" name="school_10th_mark" required>
                        </div> -->

                        <div class="mb-3">
                            <label class="form-label">10th Completion Year:</label>
                            <input type="text" class="form-control" name="school_10th_year" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">10th Percentage:</label>
                            <input type="text" class="form-control" name="school_10th_percentage" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">12th School Name:</label>
                            <input type="text" class="form-control" name="school_12th_name" required>
                        </div>

                        <!-- <div class="mb-3">
                            <label class="form-label">12th Mark:</label>
                            <input type="text" class="form-control" name="school_12th_mark" required>
                        </div> -->

                        <div class="mb-3">
                            <label class="form-label">12th Completion Year:</label>
                            <input type="text" class="form-control" name="school_12th_year" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">12th Percentage:</label>
                            <input type="text" class="form-control" name="school_12th_percentage" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Graduation College Name:</label>
                            <input type="text" class="form-control" name="college_name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">University Name:</label>
                            <input type="text" class="form-control" name="university_name" required>
                        </div>

                        <!-- <div class="mb-3">
                            <label class="form-label">CGPA:</label>
                            <input type="text" class="form-control" name="graduation_cgpa" required>
                        </div> -->

                        <div class="mb-3">
                            <label class="form-label">Percentage:</label>
                            <input type="text" class="form-control" name="graduation_percentage" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Graduation Completion Year:</label>
                            <input type="text" class="form-control" name="graduation_year" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stream:</label>
                            <input type="text" class="form-control" name="stream" required>
                        </div>

                    <div class="form-group">
                        <label for="experience">Experience or Fresher</label>
                        <select class="form-control" id="experience" name="experience" required>
                            <option value="experience">Experience</option>
                            <option value="fresher">Fresher</option>
                        </select>
                    </div>

                    <div class="form-group" id="experienceYearsGroup" style="display: none;">
                        <label for="experienceYears">Number of Years of Experience</label>
                        <input type="number" class="form-control" id="experienceYears" name="noofexp" placeholder="Enter years of experience">
                    </div>


                        <div class="mb-3">
                            <label class="form-label">Skills:</label>
                            <input type="text" class="form-control" name="skills" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Certifications:</label>
                            <input type="text" class="form-control" name="certifications">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Languages:</label>
                            <input type="text" class="form-control" name="languages">
                        </div>

                        <!-- Backlog -->
                        <div class="mb-3">
                            <label class="form-label">Backlog:</label>
                            <input type="text" class="form-control" name="backlog" required>
                        </div>


                    <div class="mb-3">
                        <label class="form-label">Profile Photo:</label>
                        <input type="file" class="form-control" name="dp" accept="image/*" required>
                    </div>

                    <!-- <div class="mb-3">
                        <label class="form-label">Document:</label>
                        <input type="file" class="form-control" name="document" accept=".pdf, .doc, .docx" required>
                    </div> -->

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>

            <div class="row mt-3">
            <div class="col-md-12">
                <a href="login.php" class="btn btn-danger">Go to login</a>
            </div>
        </div>
        </div>
    </div>

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

</body>
</html>

