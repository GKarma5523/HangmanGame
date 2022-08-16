<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <h2>Hangman the Game</h2>
    </head>
    <body>
        <p style="color:white">The development of Hangman was a good introduction to PHP as that is what the functionality is written in. Supporting the HTML markdown language, this project was developed and hosted through the free web/database host InfinityFree. 
            This gave us the ability to create a database of words based on length and pull them to the project for guessing. Below are some images of the game to give you an idea what you would see as a player.</p>

        <div class="container">
            <div class="row">
                <div class="col-md-5 px-1" width="100%">
                    <img src="Portfolio/Images/HangmanGame.pnh" alt="Hangman Game" class="border img-fluid" width="100%">
                    <p style="color:white">The main game page.</p>
                </div>
                <div class="col-md-5 px-1">
                    <img src="Portfolio/Images/HangmanGame1.png" alt="Hangman Game" class="border img-fluid" width="100%">
                    <p style="color:white">The popup when you lose.</p>
                </div>
            </div>
        </div>

        <p style="color:white">As you can see the game is relatively similar to what you would expect with most of the functionality being the focus point.</p>
        <h4>Game Play:</h4>
        <p style="color:white">You will need to create an account that will be saved in our local database. Once you login, it will allow your scores to be placed against other players on the leader board. Once logged in, you will see a game board that will show you
        your game and a set of underscores to represent the length of the word you are to guess. You will enter a letter in the guess text box and once you click submit, if the letter is correct, it will appear in the word at the bottom. If the letter is incorrect, it 
        will list it in the incorrect guess section and add a piece to your Hangman's noose. You will have the ability to play over and over as you desire or logout when you are finished.</p>
        
        <h4>Struggles</h4>
        <p>There were some big learning curves in this project as I had never worked in PHP before. I spent a good majoriety of my time learning the language as I strived to implement it. This game is still under development to get the leaderboard complete as the task 
        of passing session variables back and forth was a struggle. Below you will see some of the code base that I worked on and see some of the complexity of the language.</p>

        <div class="container">
            <div class="row">
                <div class="col-md-5 px-1" width="100%">
                    <img src="Images/HangmanCode.png" alt="Hangman Game" Code class="border img-fluid" width="100%">
                    <p style="color:white">Some code built in PHP</p>
                </div>
                <div class="col-md-5 px-1">
                    <img src="Images/HangmanCode1.png" alt="Hangman Game Code" class="border img-fluid" width="100%">
                    <p style="color:white">The HTML code designing the page.</p>
                </div>
            </div>
        </div>

    </body>
</html>
