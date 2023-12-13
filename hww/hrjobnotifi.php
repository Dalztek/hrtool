<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jobtitle = $_POST['jobtitle'];
    $openings = $_POST['openings'];
    $descreption = $_POST['descreption'];
    $experience = $_POST['experience'];
    $noofexper = $_POST['noofexper'];
    $Location = $_POST['Location'];
    $appstartdate = $_POST['appstartdate'];
    $appenddate = $_POST['appenddate'];


    require_once('dohr.php');
    $hr = new Hr($conn);
    $hr->notifiinsert($jobtitle, $openings, $descreption, $experience, $noofexper, $Location, $appstartdate, $appenddate);
    header('Location: hrdash.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Notification Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <form method="post">
            <div class="form-group">
                <label for="jobTitle">Job Title</label>
                <input type="text" class="form-control" id="jobTitle" name="jobtitle" placeholder="Enter job title" required>
            </div>

            <div class="form-group">
                <label for="openings">Openings</label>
                <input type="number" class="form-control" id="openings" name="openings" placeholder="Enter number of openings" required>
            </div>

            <div class="form-group">
                <label for="des">Required Skills</label>
                <input type="delete" class="form-control" id="des" name="descreption"  placeholder="Enter number of applications">
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
                <input type="number" class="form-control" id="experienceYears" name="noofexper" placeholder="Enter years of experience">
            </div>

            <div class="form-group">
                <label for="preferredLocation">Preferred Location</label>
                <select class="form-control" name="Location" id="preferredLocation">
                    <option value="chennai">Chennai</option>
                    <option value="bangalore">Bangalore</option>
                    <option value="coimbatore">Coimbatore</option>
                    <option value="delhi">Delhi</option>
                    <option value="hyderabad">Hyderabad</option>
                </select>
            </div>

            <div class="form-group">
                <label for="applicationStartDate">Application Start Date</label>
                <input type="date" class="form-control" name="appstartdate" id="applicationStartDate" required>
            </div>

            <div class="form-group">
                <label for="applicationEndDate">Application End Date</label>
                <input type="date" class="form-control" name="appenddate" id="applicationEndDate" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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

    <div class="row mt-3">
    <div class="col-md-12">
        <a href="hrdash.php" class="btn btn-warning">Go to dashboard</a>
    </div>
</div>

</body>

</html>
