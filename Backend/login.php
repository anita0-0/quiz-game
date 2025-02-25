<?php 
include("database.php");


session_start();
$openModal = false; // Default: Do not open modal
$message = ""; // Message to display in the modal
$isSuccess = false; // Flag to check login success

if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $pw = $_POST['password'];

    $sql1 = "SELECT * FROM login WHERE username='$name' AND password='$pw'";
    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) > 0) {
        // Login successful
        $result2 = mysqli_fetch_assoc($result1);
        $_SESSION['username'] = $result2['username'];
        $_SESSION['photo'] = $result2['photo'];
        $_SESSION['email']=$result2['email'];
        $_SESSION['name']=$result2['name'];
        $_SESSION['total_score'] = $result2['total_score'] ?? 0; // Assume "total_score" exists in your database

        $message = "Login successful! Redirecting...";
        $isSuccess = true; // Set success flag
        $openModal = true; // Show modal
    } else {
        // Login failed
        $message = "Invalid username or password!";
        $openModal = true; // Show modal
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
            @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

       /* General Reset */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url('signup1.jpg'); /* Replace 'art1.jpg' with the path to your background image */
      background-size: cover;
      background-repeat: repeat-y; /* Allows vertical scrolling */
      background-position: center 0;
      animation: scrollBackground 2s linear infinite; /* Anim ate scrolling */
      height: 100vh; /* Full viewport height */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: white;
    }

    /* Keyframes for scrolling background */
    @keyframes scrollBackground {
      0% {
        background-position: center 0;
      }
      100% {
        background-position: center 100%;
      }
    }
    button:hover {
        transform: scale(1.05);

    } 

        .login-box {
  height: 50px;
  width: 500px;
  font-size: 1.2rem;
}
    </style>
</head>

<body>
    <div style="display: flex; justify-content: center;font-size:3.5rem;font-weight:bold;font-family: 'Press Start 2P', cursive;">
        LOGIN
    </div>
    <div align="center">
        <form action="" method="POST" style="width: 1000px;">
            <fieldset>
                <legend style="font-size: 1.5rem; font-weight: bold;">Welcome to Quizdom</legend>
                <div align="left" style="width: 500px;">
                    <big><b>Username</b></big><br>
                    <input name="username" type="text" class="login-box" required autocomplete="off">
                </div><br><br><br>
                <div align="left" style="width: 500px;">
                    <big><b>Password</b></big><br>
                    <input name="password" type="password" class="login-box" required>
                </div><br><br>
                <div align="center">
                    <button type="submit" name="submit" class="btn btn-primary"
                        style="padding: 10px 30px; background-color: #CD5C5C ;color: white; font-size: 1.2rem;">Submit</button>
                </div><br><br>
                <div align="center">
                    <a href="signup.php">
                        <p style="color:white; font-size:1.3rem; cursor: pointer;">Don't have an account? Sign up</p>
                    </a>
                </div><br><br>
            </fieldset>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $message; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php if ($openModal): ?>
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();

            <?php if ($isSuccess): ?>
                setTimeout(function () {
                    window.location.href = "categorie.php";
                }, 2000);
            <?php endif; ?>
        </script>
    <?php endif; ?>
</body>

</html>