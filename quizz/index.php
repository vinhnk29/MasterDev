<?php
    // Start the session
    session_start();
    include "data.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./quiz.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="main-screen">
    <!--        your score-->
    <div id="score" class="card text-center"><span id="score-num"></span></div>

    <div id="play-content">
        <!--            question-->
        <div id="question" class="card text-center"></div>

        <!--            a button just for fun =)) -->
        <a class="btn text-center" id="submit">Click on the correct answer</a>

        <!--            list answer-->
        <div id="answer" class="d-flex justify-content-between">
            <!--                answer 1-->
            <a href="" id="answer1" class="card text-center btn answer-detail"></a>
            <!--                answer 2-->
            <a href="" id="answer2" class="card text-center btn answer-detail"></a>
            <!--                answer 3-->
            <a href="" id="answer3" class="card text-center btn answer-detail"></a>
            <!--                answer 4-->
            <a href="" id="answer4" class="card text-center btn answer-detail"></a>
        </div>

        <div id="game-over">
            <p>Game Over!!!</p>
            <p>The right answer is <?php echo $_SESSION['score']/10; ?></p>
            <p>Your score is <?php echo $_SESSION['score']; ?></p>
        </div>

    </div>
    <div id="start-btn" class="d-flex">
        <button class="btn" id="btn-start">Start Game</button>
        <div id="time-count" class="card text-center">
            <p>Time remaining: <span id="count-down-timer"></span> sec</p>
        </div>
    </div>
</div>

</body>

<script>
    const x = document.getElementById("start-btn");
    const btn = x.querySelector("button");
    const timer = document.getElementById("time-count");

    const hiddenScreen = document.getElementById("game-over");
    hiddenScreen.style.display = "none";
    timer.style.display = "none";

    btn.addEventListener("click", updateBtn);
    <?php
    if (isset($_GET["result"])) {
        echo 'loadData();';
        echo 'changeToRestartBtn();';
        echo "countdown();";
        if (isset($isWrong) && $isWrong) {
            echo 'result();';
            echo "timer.style.display = \"none\";";
        }
    }
    ?>

    function loadData(time) {
        // score data
        const parent = document.getElementById("score");
        const child = document.getElementById("score-num");
        const para = document.createElement("span");
        const node = document.createTextNode("<?php echo $_SESSION['score']; ?>");
        para.appendChild(node);
        parent.replaceChild(para, child);

        // question data
        const para1 = document.createElement("span");
        const node1 = document.createTextNode("<?php echo $num1 . " " . $gameOperator . " " . $num2 ?>");
        para1.appendChild(node1);
        const element1 = document.getElementById("question");
        element1.appendChild(para1);

        // result data
        // answer 1
        const parent21 = document.getElementById("answer");
        const child21 = document.getElementById("answer1");
        const para21 = document.createElement("a");
        para21.setAttribute("href", "index.php?result=<?=$r1?>");
        para21.setAttribute("class", "card text-center btn answer-detail");
        const node21 = document.createTextNode("<?php echo $r1; ?>");
        para21.appendChild(node21);
        parent21.replaceChild(para21, child21);

        // answer 2
        const parent22 = document.getElementById("answer");
        const child22 = document.getElementById("answer2");
        const para22 = document.createElement("a");
        para22.setAttribute("href", "index.php?result=<?=$r2?>");
        para22.setAttribute("class", "card text-center btn answer-detail");
        const node22 = document.createTextNode("<?php echo $r2; ?>");
        para22.appendChild(node22);
        parent22.replaceChild(para22, child22);

        // answer 3
        const parent23 = document.getElementById("answer");
        const child23 = document.getElementById("answer3");
        const para23 = document.createElement("a");
        para23.setAttribute("href", "index.php?result=<?=$r3?>");
        para23.setAttribute("class", "card text-center btn answer-detail");
        const node23 = document.createTextNode("<?php echo $r3; ?>");
        para23.appendChild(node23);
        parent23.replaceChild(para23, child23);

        // answer 4
        const parent24 = document.getElementById("answer");
        const child24 = document.getElementById("answer4");
        const para24 = document.createElement("a");
        para24.setAttribute("href", "index.php?result=<?=$r4?>");
        para24.setAttribute("class", "card text-center btn answer-detail");
        const node24 = document.createTextNode("<?php echo $r4; ?>");
        para24.appendChild(node24);
        parent24.replaceChild(para24, child24);
    }

    function changeToRestartBtn() {
        btn.textContent = "Restart Game";
    }

    function updateBtn() {
        if (btn.textContent === "Start Game") {
            btn.textContent = "Restart Game";
            countdown();
            // click start to get data
            loadData();
        } else {
            window.location.href = "index.php";
        }
    }

    function result() {
        hiddenScreen.style.display = "block";
        btn.textContent = "Restart Game";
    }

    function countdown() {
        timer.style.display= "block";
        let timeLeft = <?= 5 ?>;
        document.getElementById("count-down-timer").textContent = timeLeft;
        const downloadTimer = setInterval(function () {
            timeLeft--;
            document.getElementById("count-down-timer").textContent = timeLeft;
            //Set time for link
            if (timeLeft <= 0){
                clearInterval(downloadTimer);
                result();
            }
        }, 1000);
    }
</script>

</html>
