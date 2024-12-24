<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>patient_management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
   <div class ="container mt 5" >
    <h2>list of patients</h2>
     
    <a Class="btw btw primary" href="/patient_management/create.php"role = button>Add New patient</a>
    

    <br>
    <table class="table table bordered">
  <thead>
    <tr>
      <th scope="col">patient_id</th>
      <th scope="col">name</th>
      <th scope="col">dob</th>
      <th scope="col">contact_info</th>

    </tr>
  </thead>
  <tbody>
    <tr>
 </thead>
 <tbody>
    <?php
    $servername = "localhost"; 
    $username = "root";
    $password = "";
    $database = "patient_management";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    //check connection
    if ($connection->connect_error) { 
        die("Connection failed: " . $connection->connect_error); }

        //read all row from database table
        $sql = "SELECT * FROM Patients";
        $result = $connection->query($sql);
        
        if (!$result)  {
          
            die ("Invalid query:" .$connection->error);
        }

        //read data of each row
        while ($row= $result-> fetch_assoc()) {
            echo "
             <tr>
    <td>$row[patient_id]</td>
    <td>$row[name]</td>
    <td>$row[dob]</td>
    <td>$row[contact_info]</td>


    
     </tr>
            
            ";
        }
    ?>


</tbody>
   </table>
   </div> 
</body>
</html>