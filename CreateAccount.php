<?php
    session_start();
    include("ConnectionInfo.php");

    $_SESSION["LoggedIn"] = FALSE;
    $user = $_POST["UserName"];
    $pass = $_POST["Password"];
    $confpass = $_POST["ConfirmPassword"];
    $_SESSION["PassValid"] = TRUE;

    if($user != NULL && $pass != NULL && $confpass != NULL) {

        $pLength = strlen($pass);
        if($pLength < 8){
            $_SESSION["PassValid"] = FALSE;
        }

        $conn = new mysqli($servername, $username, $password, $dbname);
        if($conn->connect_error){
            die("Connection Failed");
        }
        $sql = "SELECT * FROM Hangman WHERE UserName = '$user'";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            $_SESSION["UserError"] = TRUE;
        }
        else if($pass == $confpass && $_SESSION["PassValid"]) {
            $salt = random_bytes(6);
            $hash = hash("sha256", $pass . $salt, FALSE);
            $sql = "INSERT INTO Hangman (UserName, Salt, Hash)
                    VALUES ('$user', '$salt', '$hash')";
            
            if($conn->query($sql) === TRUE) {
                $sql = "SELECT Word, LetterCount FROM Wordlist ORDER BY RAND() LIMIT 1;";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $_SESSION["Word"] = $word;
                $_SESSION["WordArray"] = array();
                $word = $row["Word"];
                $letterCount = $row["LetterCount"];
                for($i = 0; $i < $letterCount; $i++) {
                    $_SESSION["WordArray"][$i] .= "_";
                }
                $_SESSION["User"] = $user;
                $_SESSION["LetterCount"] = $letterCount;
                $_SESSION["CorrectGuess"] = 0;
                $_SESSION["WrongGuess"] = 0;
                $_SESSION["LoggedIn"] = TRUE;
                header("location: Game.php");
                exit;
            }
            else{
                echo "Error.";
            }
            $conn->close();
        }
        else{
            $_SESSION["PassError"] = TRUE;
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <body>

        <div class="container mx-auto w-50">
            <h3 class="mt-4 text-center">Create an Account</h3>
            <form action="CreateAccount.php" method="post">
                <div class="form-group">
                    <label for="Username">Username:</label>
                    <input type="text" class="form-control" name="UserName" id="UserName" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="Password">Password:</label>
                    <input type="password" class="form-control" name="Password" id="Password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="ConfirmPassword">Confirm Password:</label>
                    <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword" placeholder="Confirm Password">
                </div>
                <input type="submit" value="Submit" class="btn btn-primary">
            </form>
            


            <?php if($_SESSION["PassError"] === FALSE) : ?>
                <div class="container mt-4 pt-2 mx-auto border border-warning text-muted text-center">
                    <p>Invalid Password</p>
                </div>
                <?php $_SESSION["PassError"] = FALSE; ?>
            <?php endif; ?>
            
            <?php if($_SESSION["UserError"]) : ?>
                <div class="container mt-4 pt-2 mx-auto border border-warning text-muted text-center">
                    <p>USername is already taken.</p>
                </div>
                <?php $_SESSION["UserError"] = FALSE; ?>
            <?php endif; ?>

            <?php if($_SESSION["PassValid"] === FALSE) : ?>
                <div class="container mt-4 pt-2 mx-auto border border-warning text-muted text-center">
                    <p>Password must be at least 8 characters.</p>
                </div>
                <?php $_SESSION["PassValid"] = TRUE; ?>
            <?php endif; ?>
                
            <br>
            <p>Have an Account? <a href="Hangman.php">Click Here</p>
        </div>

            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>