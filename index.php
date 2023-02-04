<?php include('server.php') ?>


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
    <p>Where education meets fun!</p>
  	<h2>Please Login</h2>
    <div class="mb-3" style="width:50%">
        <form method="post" action="index.php">
            <?php include('errors.php'); ?>
                <label for="role" class="form-label">I am a:</label>
                <select class="form-control" name="roles">
                    <option value="none" disabled> choose 1</option>
                    <option value="Student">Student</option>
                    <option value="Tutor">Tutor</option>
                    
                </select>
                <label for="username" class="form-label">Input your first name</label>
                <input type="text" class="form-control" name="username">
                <label for="password" class="form-label">password</label>
                <input type="password" class="form-control" name="password">
                
                <button type="submit" name="login" class="btn btn-primary">Submit</button>
            <p>
                New Students/Teachers should register <a href="register.php">here</a>
            </p>
        </form>
      </div>  


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>