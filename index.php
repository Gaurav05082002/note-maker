
<!-- connection with backend  -->
 
 <?php

// INSERT INTO `notes` (`s.no`, `title`, `description`, `tstamp`) VALUES (NULL, 'buy books ', 'i want you to buy books \r\n', current_timestamp());
 //connect to data base 
 $insert = false;
 $update = false;
$delete = false;
 $servername="localhost";
 $username="root";
 $password="";
 $database="notes";
 $conn = mysqli_connect($servername, $username ,$password,$database);
 if (!$conn){
     die("unable to connect :" . mysqli_connect_error() ); 
 }

//  edit();
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `s.no` = $sno";
  $result = mysqli_query($conn, $sql);
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 
   if(isset( $_POST['snoEdit'])){
    $sno = $_POST["snoEdit"];
     $title = $_POST["titleEdit"];
     $description = $_POST["descriptionEdit"];
     
     // for getting update query edit somthing in admin local host
     $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`s.no` = $sno";
     // $sql = "INSERT INTO `phptrip` (`name`, `dest`) VALUES ('$name', '$destination')";
     $result = mysqli_query($conn, $sql);
   }

   else {
  $title = $_POST["title"];
  $description = $_POST["description"];
  
  // Sql query to be executed
  $sql="INSERT INTO `notes` (`s.no`, `title`, `description`, `tstamp`) VALUES (NULL, '$title', '$description \r\n', current_timestamp());";
  // $sql = "INSERT INTO `phptrip` (`name`, `dest`) VALUES ('$name', '$destination')";
  $result = mysqli_query($conn, $sql);
  
  // Add a new trip to the Trip table in the database
  if($result){
      // echo "The record has been inserted successfully successfully!<br>";
      $insert = true;
    //   else {
    //     echo "connection suceesss full";
    // }
  }
  else{
      echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
  }
 }
 }

 ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- the next css link and two script tags is from data table jquery inclusions , from datatables.net -->
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- including jquery uncompressed from first paragraph in googling jquery cdn -->
    
   
   
    <style>
      /* .out{
        margin: "-320px";
        margin-top: -41rem !important;
        border: solid 2px red;
      } */
    body {
 background-image: url("christopher-gower-vjMgqUkS8q8-unsplash (1).jpg");
 
 }
      
    </style>
 
    
    <title>inotes</title>
  
  </head>
  <body>
   

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/crud/index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>





    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand"  href="#"><strong>i</strong>notes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <!-- <a class="nav-link" href="#">About</a> -->
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://www.facebook.com/profile.php?id=100058355270007">Contact us</a>
              </li>
              </ul>
            <form class="d-flex">
           
            </form>
          </div>
        </div>
      </nav>

      <!-- for making user feel that succesfull submission we have used a vraible called $insert which is false instioally but cahnges to true when submission is succesful -->
      <?php 

if($insert){
  echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>SUCCESS!</strong> Your notes have been submitted .
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

      ?>

<?php
  if($delete){
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>SUCCESS!</strong> Your notes have been deleted .
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>SUCCESS!</strong> Your notes have been updated .
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>




      <div class="container my-3"> 
          <h2>add a note</h2>

          <!-- STEP1 > adding crud and method toform , so jo info title or desc me ayengi vo post ho jayegi -->
        <form action = "/crud/index.php" method ="post">
            <div class="mb-3">
              <label for="title" class="form-label">NOTE TITLE</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
             
            </div>
            
            <div class="mb-3">
                <label for="desc" class="form-label">NOTE DESCRIPTION</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              </div>
            <button type="submit" class="btn btn-primary">ADD NOTE</button>
          </form>
      </div>




      
      <div class="container my-3" > 

      <!-- presenting the dat a that is set in backend  -->

         
        <!-- //   $sql = "SELECT * FROM `notes`";
        //   $result = mysqli_query($conn ,$sql);
        //   while($row = mysqli_fetch_assoc($result)){
        //     echo $row['s.no'] .  ". Title ". $row['title'] ." Desc is ". $row['description'] ;
            
        //     echo "<br>";
        // }
         -->

<!-- here a new id called my table is given because the script we includede through jquery and data base net is applied on #my table and we want that table to be this table  -->
<table class="table" class="out" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   
    <?php 
          $sql = "SELECT * FROM `notes`";
          $result = mysqli_query($conn ,$sql);
          $sno=0;
          while($row = mysqli_fetch_assoc($result)){
           $sno=$sno+1; 
            echo "<tr>
            <th scope='row'>".$sno."</th>
            <td>".$row['title']."</td>
            <td>".$row['description']."</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['s.no'].">Edit</button> 
            <button class='delete btn btn-sm btn-primary' id=d".$row['s.no'].">Delete</button> 
            
             </td>
          </tr>";
           // echo var_dump($row);
            // echo $row['s.no'] .  ". Title ". $row['title'] ." Desc is ". $row['description'] ;
          
        }
          


 


          ?>
  </tbody>
</table>




      </div>

    <h1></h1>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- including jquery from jquery cdn -->
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    
    
    
    <!-- the next script is again from database table.net -->
    <script> 
    $(document).ready( function () {
    $('#myTable').DataTable();
} );  
  </script>

<script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })



    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/crud/index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  

    </script>


  </body>
</html>