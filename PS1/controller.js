// Jakub Szpunar
// CS4540 Web Software Architecture Spring 2013
// PS1
// January 2013

$(document).ready(function () {
    // Get the canvas and context we are using.
    var canvas = $("#canvas")[0];
    var context = canvas.getContext("2d");
    // Get the width and height of the canvas we are drawing to.
    var width = $("#canvas").width();
    var height = $("#canvas").height();

    // Define global variables.    
    var blockSize = 10;         // The width/height of each block on the gameboard.    
    var updateInterval = 60;    // Define how often the game updates in ms. Changing this changes the pace of the game.    
    var snake;                  // Array that stores the positions of each part of the snake.    
    var snakeInitLength = 5;    // Define how long the snake starts out as.    
    var movementDirection;      // Wich direction the snake is moving in. Right = 0, Up = 1, Left = 2, Down = 3.    
    var snakeColor = "blue", appleColor = "red";    // The snake and apple colors.    
    var apple;                  // The location on the screen of the current apple.    
    var playerScore;            // The player's score. (How maheadY apples have been consumed).
    var gamePaused = false;     // Whether the game is paused.
    var gameStarted = false;    // Whether the game has been started.
    var snakeDead = false;      // Whether the snake is dead.

    // Initialize the game loop.
    function init() {
        // Call the paint function every updateInterval ms.
        // If it already has an interval, clear it first.
        if (typeof game_loop != "undefined")
            clearInterval(game_loop);
        game_loop = setInterval(paint, updateInterval);
    }

    // Call to initialize the game loop.
    init();
    // Link HTML buttons to functions.
    $("#pauseButton").click(pauseButtonPress);
    $("#startButton").click(start);
    $("#speedSelect").change(changeSpeed);

    // Start a game going. Snake now moves etc.
    function start() {
        // Set the default movement direction.
        movementDirection = 0;
        // Spawn a snake to the gameboard.
        spawnSnake();
        // Spawn an apple to the gameboard.
        spawnApple(); //Now we can see the food particle
        // Set the player score to zero.
        playerScore = 0;
        gameStarted = true;
        gamePaused = false;
        snakeDead = false;
    }

    // Changes the speed of the game.
    function changeSpeed() {
        updateInterval = $("#speedSelect").val();
        if (typeof game_loop != "undefined")
            clearInterval(game_loop);
        game_loop = setInterval(paint, updateInterval);
        $("#speedSelect").removeAttr("selected");
    }

    // Change the pause status of the game.
    // Either by clicking pause, or pressing <p> or <pause/break>
    function pauseButtonPress() {
        // If the snake is dead, do not allow the pause status to changed.
        // Game must be started again instead.
        if (snakeDead == true)
            return;
        if (gamePaused == true) {
            gamePaused = false;
            $("#pauseButton").css("background-color", "darkcyan");
        }
        else {
            gamePaused = true;
            $("#pauseButton").css("background-color", "red");
        }
    }

    // Spawn a snake to the gameboard.
    function spawnSnake() {
        // Initialize/blank out the snake array.
        snake = [];
        // Create a snake of length snakeInitLength facing right starting in the top left.
        for (var i = snakeInitLength - 1; i >= 0; i--) {
            snake.push({ x: i, y: height / (2 * blockSize) });
        }
    }

    // Create an apple in a random place in the gameboard.
    function spawnApple() {
        apple = {
            x: Math.round(Math.random() * (width - blockSize) / blockSize),
            y: Math.round(Math.random() * (height - blockSize) / blockSize),
        };
    }

    // Go through the game logic and paint/update to the screen.
    function paint() {
        // Draw the game board to the screen. Outline the edges in black.
        context.fillStyle = "white";
        context.fillRect(0, 0, width, height);
        context.strokeStyle = "black";
        context.strokeRect(0, 0, width, height);

        // If the game hasn't started, don't do game logic / snake drawing.
        if (gameStarted == false) {
            context.fillText("Score: " + playerScore, 5, height - 5);
            return;
        }

        // If the game is paused, draw the game, but don't update the game.
        if (gamePaused == true) {
            drawSnake();
            drawApple();
            context.fillText("Score: " + playerScore, 5, height - 5);
            return;
        }
       
        // Otherwise in normal game behaviour.

        // Get the coordinates of the current head of the snake.
        var headX = snake[0].x;
        var headY = snake[0].y;

        // Figure out where the head now is based on snake movement.
        if (movementDirection == 0)
            headX++;
        else if (movementDirection == 2)
            headX--;
        else if (movementDirection == 1)
            headY--;
        else if (movementDirection == 3)
            headY++;

        // Check to see if any collisions occured, if so, restart the game.
        if (hasCollided(headX, headY)) {
            gamePaused = true;
            snakeDead = true;
            return;
        }

        // Create a location for the new head of the snake.
        var newHead;
        // If the snake ate an apple, set the new head to be where the apple was and spawn another piece of food.
        // If an apple was not consumed, remove the tail piece of the snake from the array.
        if (headX == apple.x && headY == apple.y) {
            newHead = { x: headX, y: headY };
            playerScore++;
            spawnApple();
        }
        else {
            newHead = snake.pop();
            newHead.x = headX;
            newHead.y = headY;
        }

        // Move the new head to now be the snake actual head.
        snake.unshift(newHead);

        // Draw the snake/apple/scores to the screen.
        drawSnake();
        drawApple();
        context.fillText("Score: " + playerScore, 5, height - 5);
    }

    // Draw the snake to the screen.
    function drawSnake() {
        context.fillStyle = snakeColor;
        context.strokeStyle = "white";
        for (var i = 0; i < snake.length; i++) {
            context.fillRect(snake[i].x * blockSize, snake[i].y * blockSize, blockSize, blockSize);
            context.strokeRect(snake[i].x * blockSize, snake[i].y * blockSize, blockSize, blockSize);
        }
    }
    // Draw an apple to the screen.
    function drawApple() {
        context.fillStyle = appleColor;
        context.strokeStyle = "white";
        context.fillRect(apple.x * blockSize, apple.y * blockSize, blockSize, blockSize);
        context.strokeRect(apple.x * blockSize, apple.y * blockSize, blockSize, blockSize);
    }

    // Check to see if the snake collided with the walls, or with itself.
    function hasCollided(x, y) {
        // Check for wall collisions.
        if (x == -1 || x == width / blockSize || y == -1 || y == height / blockSize)
            return true;

        // Check for snake collisions.
        for (var i = 0; i < snake.length; i++) {
            if (snake[i].x == x && snake[i].y == y)
                return true;
        }
    }

    // Get keystrokes from the keyboard to set movement or alter the pause state of the game.
    $(document).keydown(function (e) {
        var key = e.which;
        if (key == "37" && movementDirection != 0) movementDirection = 2;
        else if (key == "38" && movementDirection != 3) movementDirection = 1;
        else if (key == "39" && movementDirection != 2) movementDirection = 0;
        else if (key == "40" && movementDirection != 1) movementDirection = 3;
        else if (key == "80" || key == "19") pauseButtonPress();
    })
})



