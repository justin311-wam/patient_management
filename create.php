<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "patient_management"; 

//create connection
$connection =new mysqli($servername,$username,$password,$dbname);



$patient_id = "";
$name = "";
$dob = "";
$contact_info = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST["patient_id"];
    $name = $_POST["name"];
    $dob = $_POST["dob"];
    $contact_info = $_POST["contact_info"];

    do {
        if (empty($patient_id) || empty($name) || empty($dob) || empty($contact_info)) {
            $errorMessage = "All fields are required";
            break;
        }

        // Add new patient to the database
        $sql = "INSERT INTO Patients (patient_id,name, dob, contact_info) VALUES ('$patient_id','$name', '$dob', '$contact_info')";
        $results = $connection->query ($sql);

        if (!$results) {
            $errorMessage="Invalid query:" .$connection->error;
            break;
        }
        $name = "";
        $dob = "";
        $contact_info = "";

        $successMessage = "Patient added correctly";

        header ("location:/patient_management/index.php");
        

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient_Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js
"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Patient</h2>

        <?php
    if (!empty($errorMessage)) {
        echo "
       <div class='alert alert-warning alert-dismissable fade show' role='alert'>
       <strong>$errorMessage</strong>
       <button type='button' class='close' data-bs-dismiss='alert' aria-label='close'></button>
       </div>
        ";
    }
?>

<form method="post">
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">patient_id</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="patient_id" value="<?php echo $patient_id; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">dob</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="dob" value="<?php echo $dob; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">contact_info</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="contact_info" value="<?php echo $contact_info; ?>">
        </div>
    </div>


            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/patient_management/index.php" role="button">Cancel</a> 
                </div>
            </div>
            
            </div>
        </form>
    </div>
</body>
</html>
