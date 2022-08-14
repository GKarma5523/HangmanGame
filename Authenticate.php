<?php

    session_start();
    include("ConnectionInfo.php");
    $user = $_POST["UserName"];
    $pass = $_POST["Password"];

    $sql = "SELECT Hash, Salt FROM Hangman WHERE UserName = '$user'";
    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("Connection Failed");
    }

    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hash = $row["Hash"];
        $salt = $row["Salt"];
        $verify = hash("sha256", $pass . $salt, FALSE);

        if($verify === $hash) {
            $sql = "SELECT Word, LetterCount FROM WordList ORDER BY RAND() LIMIT 1;";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $word = $row["Word"];
            $letterCount = $row["LetterCount"];
            $_SESSION["Word"] = $word;
            $_SESSION["WordArray"] = array();
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
        else {
            $_SESSION["PassError"] = TRUE;
            header("location: Hangman.php");
            exit;
        }
    }
    else {
        $_SESSION["UserError"] = TRUE;
        header("location: Hangman.php");
        exit;
    }
    $conn->close();

?>