<?php
class Hr {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function notifiinsert($jobtitle, $openings, $descreption, $experience, $noofexper, $Location, $appstartdate,$appenddate) {
        $insert_value = "INSERT INTO job_notifi (job_title, openings, description, experience,no_of_exp, location, app_start_date, app_end_date)
        VALUES ('$jobtitle', '$openings','$descreption', '$experience', '$noofexper', '$Location', '$appstartdate','$appenddate')";
        $connect = $this->conn->query($insert_value); 
    }

    public function hrtable() {
        $select_value1 = "SELECT * FROM job_notifi";
        $hrsel1 = mysqli_query($this->conn, $select_value1);
        return $hrsel1;
    }

        public function deljobss($deljob) {
            $delsqljob = "DELETE FROM job_notifi WHERE job_noti_id ='$deljob'";
            $deljob = $this->conn->query($delsqljob);
            if ($deljob) {
                return true;
            } else {
                return false;
            }
        }

           public function editjobss($jobtitle1, $openings1, $descreption1, $experience1, $noofexper1, $Location1, $appstartdate1, $appenddate1, $deljobid) {
                $upsql = "UPDATE job_notifi SET 
                                job_title='$jobtitle1', 
                                openings='$openings1', 
                                description='$descreption1', 
                                experience='$experience1', 
                                no_of_exp='$noofexper1', 
                                location='$Location1',
                                app_start_date='$appstartdate1',
                                app_end_date='$appenddate1' 
                                WHERE job_noti_id='$deljobid'";

                if ($aa = mysqli_query($this->conn, $upsql) === TRUE) {
                    header('Location: jobnotitable.php');
                } else {
                    echo "Error updating database: " . $this->conn->error;
                }
            }
}
?>
