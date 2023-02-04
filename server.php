<?php
session_start();

include ('connect.php');

// initializing variables
$fname = "";
$lname = "";
$username = "";
$course    = "";
$errors = array(); 



// REGISTER USER
if (isset($_POST["register"])) {
  // receive all input values from the form
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $course = mysqli_real_escape_string($db, $_POST['course']);
  $password_1 = mysqli_real_escape_string($db, $_POST['pass1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['pass2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fname)) { array_push($errors, "First Name is required"); }
  if (empty($lname)) { array_push($errors, "Last Name is required"); }
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($course)) { array_push($errors, "Course is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE Username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password_hash = md5($password_1);//encrypt the password before saving in the database
  	$query = "INSERT INTO users (F_Name, L_Name, username, Course, Password) 
  			  VALUES('$fname','$lname', '$username', '$course', '$password_hash')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: xfactor.php');
  }
}

// LOGIN USER
if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
    
  	$query = "SELECT * FROM users WHERE username='$username' AND Password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  //$_SESSION['username'] = $username;
  	  //$_SESSION['success'] = "You are now logged in";
  	  header('location: xfactor.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>