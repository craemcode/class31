<?php include('server.php')?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register with Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body style="padding: 5%">
  <h1>Ochwangi University</h1>
    
    <h2>Register</h2>
    <div class="mb-3" style="width:50%">
        <form method="post" action="register.php">
        <?php include('errors.php'); ?>
            <label for="Fname" class="form-label">First Name</label>
            <input type="text" class="form-control" name="fname">


            <label for="lname" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="lname">


            <label for="role" class="form-label">I am a:</label>
            <select class="form-control" name="role">
                <option value="none" disabled> choose 1</option>
                <option value="Student">Student</option>
                <option value="Tutor">Tutor</option>
                
            </select>



            <label for="password1" class="form-label">Password</label>
            <input type="password" class="form-control" name="pass1">

            <label for="password2" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="pass2">

            <button type="submit" name="register" class="btn btn-primary">Submit</button>
        </form>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>