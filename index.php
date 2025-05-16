<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRISM - Refracting Identity, Reflecting You</title>
    <link rel="stylesheet" href="style.css">  
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Montserrat:wght@700&display=swap" rel="stylesheet">
</head>
<body>


    <div class="logo-container">
        <img src="PRISM.png" alt="PRISM Logo" class="logo" width="200"> 
        <h1 class="tagline">Refracting Identity, Reflecting You</h1>
    </div>

    <div class="container" id="signup">
        <h1>Register</h1>
        <form method="POST" action="Register.php" enctype="multipart/form-data">
            <input type="text" name="first_name" placeholder="First Name" required><br>
            <input type="text" name="last_name" placeholder="Last Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Sign Up" name="signup">
        </form>
        <p>Already have an account? <a href="Login.php">Login here</a></p>
    </div>

</body>
</html>
