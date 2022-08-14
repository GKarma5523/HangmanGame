<?php
    session_start();
    $userError = $_SESSION["UserError"];
    $passError = $_SESSION["PassError"];
    $_SESSION["LoggedIn"] = FALSE;
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <body>

        <div class="container mx-auto w-50">
            <h3 class="mt-4 text-center">Welcome to Hangman</h3>
            <form action="Authenticate.php" method="post">
                <div class="form-group">
                    <label for="Username">Username:</label>
                    <input type="text" class="form-control" name="UserName" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="Password">Password:</label>
                    <input type="password" class="form-control" name="Password" placeholder="Password">
                </div>
                <input type="submit" value="Submit" class="btn btn-primary">
            </form>
            
            <?php if($userError === TRUE) : ?>
                <div class="container mt-4 pt-2 mx-auto border border-warning text-muted text-center">
                    <p>Not a valid Username</p>
                </div>
                <?php endif; ?>
                
                <?php if($passError === TRUE) : ?>
                    <div class="container mt-4 pt-2 mx-auto border border-warning text-muted text-center">
                        <p>Invalid Password</p>
                    </div>
                    <?php endif; ?>
                    
                    <?php
                if($userError || $passError){
                    session_unset();
                    session_destroy();
                }
            ?>

            <br>
            <p><a href="CreateAccount.php">Click Here</a> to create an account.</p>
        </div>

            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
