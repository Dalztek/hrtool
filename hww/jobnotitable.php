<?php
session_start();
require_once('db.php');


require_once('dohr.php');
$dohr = new Hr($conn);
$hrsel1 = $dohr->hrtable();


if (isset($_POST['submit1'])) {
    $deljob = $_POST['deljob'];
    $isDeleted = $dohr->deljobss($deljob);
    if ($isDeleted) {
        header('Location: jobnotitable.php');
    } else {
        echo "Failed to delete job.";
    }
}


if (isset($_POST['submit2'])) {
    $deljobid = $_POST['deljob1'];
    $jobtitle1 = $_POST['jobtitle1'];
    $openings1 = $_POST['openings1'];
    $descreption1 = $_POST['descreption1'];
    $experience1 = $_POST['experience1'];
    $noofexper1 = $_POST['noofexper1'];
    $Location1 = $_POST['Location1'];
    $appstartdate1 = $_POST['appstartdate1'];
    $appenddate1 = $_POST['appenddate1'];

    $isDeleted1 = $dohr->editjobss($jobtitle1, $openings1, $descreption1, $experience1, $noofexper1, $Location1, $appstartdate1, $appenddate1, $deljobid);
    if ($isDeleted1) {
        header('Location: jobnotitable.php');
    } else {
        echo "Failed to delete job.";
    }
}
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
<div class="row mt-3">
  <div class="col-md-12">
    <a href="hrdash.php" class="btn btn-secondary">Go to dashboad</a>
  </div>
</div>
<div class="container-fluid mt-3">           
  <table class="table table-success table-hover shadow-lg">
    <thead>
      <tr>
        <th>Job title</th>
        <th>Openings</th>
        <th>Description</th>
        <th>Experience or Fresher</th>
        <th>Number of Years of Experience</th>
        <th>Preferred Location</th>
        <th>Application Start Date</th>
        <th>Application End Date</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($hrsel1) {
          while ($row1 = $hrsel1->fetch_assoc()) {
      ?>
            <tr>
                <td><?php echo $row1['job_title']; ?></td>
                <td><?php echo $row1['openings']; ?></td>
                <td><?php echo $row1['description']; ?></td>
                <td><?php echo $row1['experience']; ?></td>
                <td><?php echo $row1['no_of_exp']; ?></td>
                <td><?php echo $row1['location']; ?></td>
                <td><?php echo $row1['app_start_date']; ?></td>
                <td><?php echo $row1['app_end_date']; ?></td>
                <td>
                  <div class="col-md-12">
                    <form method="post" action="jobnotitable.php">
                        <input type="hidden" name="deljob1" value="<?php echo $row1['job_noti_id']; ?>">
                        <div class="text-center">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                                EDIT
                            </button>
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog  modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header ">
                                            <h4 class="modal-title text-primary">
                                               UPDATE JOB
                                            </h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                          <div class="container mt-5">
                                              <div class="form-group">
                                                  <label for="jobTitle">Job Title</label>
                                                  <input type="text" class="form-control" id="jobTitle" name="jobtitle1" placeholder="Enter job title" value="<?php echo $row1['job_title']; ?>" required>
                                              </div>

                                              <div class="form-group">
                                                  <label for="openings">Openings</label>
                                                  <input type="number" class="form-control" id="openings" name="openings1" placeholder="Enter number of openings" required value="<?php echo $row1['openings']; ?>">
                                              </div>
                                              <div class="form-group">
                                                  <label for="des">Description</label>
                                                  <input type="delete" class="form-control" id="des" name="descreption1"  placeholder="Enter number of applications" value="<?php echo $row1['description']; ?>">
                                              </div>

                                              <div class="form-group">
                                                  <label for="experience">Experience or Fresher</label>
                                                  <select class="form-control" id="experience" name="experience1" required>
                                                      <option value="experience">Experience</option>
                                                      <option value="fresher">Fresher</option>
                                                  </select>
                                              </div>

                                              <div class="form-group" id="experienceYearsGroup" style="display: none;">
                                                  <label for="experienceYears">Number of Years of Experience</label>
                                                  <input type="number" class="form-control" id="experienceYears" name="noofexper1" placeholder="Enter years of experience">
                                              </div>

                                              <div class="form-group">
                                                  <label for="preferredLocation">Preferred Location</label>
                                                  <select class="form-control" name="Location1" id="preferredLocation">
                                                      <option value="chennai">Chennai</option>
                                                      <option value="bangalore">Bangalore</option>
                                                      <option value="coimbatore">Coimbatore</option>
                                                      <option value="delhi">Delhi</option>
                                                      <option value="hyderabad">Hyderabad</option>
                                                  </select>
                                              </div>

                                              <div class="form-group">
                                                  <label for="applicationStartDate">Application Start Date</label>
                                                  <input type="date" class="form-control" name="appstartdate1" id="applicationStartDate" required value="<?php echo $row1['job_title']; ?>">
                                              </div>

                                              <div class="form-group">
                                                  <label for="applicationEndDate">Application End Date</label>
                                                  <input type="date" class="form-control" name="appenddate1" id="applicationEndDate" required value="<?php echo $row1['job_title']; ?>">
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

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="submit2" class="btn btn-primary" data-bs-dismiss="modal">Submit and Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                </td>
                <td>
                <div class="col-md-12">
                <form method="post" action="jobnotitable.php">
                    <input type="hidden" name="deljob" value="<?php echo $row1['job_noti_id']; ?>">
                    <div class="text-center">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal1">
                            REMOVE
                        </button>
                        <div class="modal fade" id="myModal1">
                            <div class="modal-dialog  modal-dialog-scrollable">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-primary">
                                            <!-- Add your title here if needed -->
                                        </h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <button type="submit" name="submit1" class="btn btn-danger">REMOVE JOB</button>
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

              </td>
            </tr>
      <?php
          }
      }
      ?>
    </tbody>
  </table>
</div>

</body>
</html>
