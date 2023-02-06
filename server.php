<?php
session_start();

include ('connect.php');

// initializing variables
$fname = NULL;
$lname = NULL;
$role = NULL;
//$course    = "";
$user=NULL;
$errors = array();
$password_hash=NULL; 



// REGISTER USER
if (isset($_POST["register"])) {
  // receive all input values from the form
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $role = mysqli_real_escape_string($db, $_POST['role']);
  //$username = mysqli_real_escape_string($db, $_POST['role']);
  //$course = mysqli_real_escape_string($db, $_POST['course']);
  $password_1 = mysqli_real_escape_string($db, $_POST['pass1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['pass2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fname)) { array_push($errors, "First Name is required"); }
  if (empty($lname)) { array_push($errors, "Last Name is required"); }
  if (empty($role)) { array_push($errors, "Role is required"); }
  //if (empty($course)) { array_push($errors, "Course is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  echo "we wre okay. here is $role";
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  switch (strtolower($role)){
    case "student":

        $user_check_query = "SELECT * FROM students WHERE fname='$fname' AND lname='$lname'";
        $result = mysqli_query($db, $user_check_query) or die(mysql_error()); 
        $user = mysqli_fetch_assoc($result);
        break;

    case "tutor":
      $user_check_query = "SELECT * FROM teachers WHERE fname='$fname' AND lname='$lname' ";
      $result = mysqli_query($db, $user_check_query) or die(mysql_error());
      $user = mysqli_fetch_assoc($result);
      break;
    default:
      array_push($errors, "Could not confirm user!");
    }

  
 
  
    if (!is_null($user)) { // if user exists
      array_push($errors, "Username already exists");
    }

  
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password_hash = password_hash($password_1, PASSWORD_DEFAULT);//hash the password before saving in the database
    
    if (strtolower($role) == "student"){
      $query = "INSERT INTO students (fname, lname, password) 
            VALUES('$fname','$lname','$password_hash')";
      mysqli_query($db, $query);
      
      header('location: login.php');

    }elseif(strtolower($role)=="tutor"){
        $query = "INSERT INTO teachers (fname, lname, password) 
            VALUES('$fname','$lname','$password_hash')";
        mysqli_query($db, $query);
        $_SESSION['role'] = $role;
        $_SESSION['fname'] = $fname;
        header('location: index.php');
  	
  }
}
}

// LOGIN USER
if (isset($_POST["login"])) {
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $role = mysqli_real_escape_string($db, $_POST['role']);

  if (empty($fname)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	
      
    switch(strtolower($role)){
      case "student":
        $query = "SELECT * FROM students WHERE fname='$fname'";
        $result = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($result);
        $password_hash = $user['password'];

        if (password_verify($password,$password_hash)){   
    
          $_SESSION['role'] = $role;
          $_SESSION['fname'] = $fname;
          header('location: student.php');
        }else {
          array_push($errors, "Wrong username/password combination for student");
        }
        break;
      
      case "tutor":
        $query = "SELECT * FROM teachers WHERE fname='$fname'";
        $result = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($result);
        $password_hash = $user['password'];

        if (password_verify($password,$password_hash)){   
    
          $_SESSION['role'] = $role;
          $_SESSION['fname'] = $fname;
          header('location: teacher.php');
        }else {
          array_push($errors, "Wrong username/password combination for student");
        }
          
              
            break;
      default:
      array_push($errors, "Could not complete operation");

      }
  	}
}



?>