<?php

$targetTime = '15:00';

$givenTargetTime = trim($_SERVER['REQUEST_URI'], '/');
if (!empty($givenTargetTime)) {
    $targetTime = $givenTargetTime;
}

$targetDateTime = date('Y-m-d').' '.$targetTime;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hacking The Values countdown</title>

    <!-- Bootstrap -->
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
<img src="/img/loreto-logo.png" style="float: left;">
<img src="/img/loreto-logo.png" style="float: right;">
<h1 id="mainHeader">Mary Ward Day 2016</h1>
<h2>Hacking The Values</h2>

<div id="clockDisplay">
    <span class="hours"></span>:<span class="minutes"></span>:<span class="seconds"></span>
</div>
<div id="stopHacking" class="hidden">
    <h1>Time's up. Stop Hacking!</h1>
</div>
</body>
<script>
    function getTimeRemaining(endtime) {
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor((t / 1000) % 60);
        var minutes = Math.floor((t / 1000 / 60) % 60);
        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        return {
            'total': t,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }

    function updateClock() {
        var t = getTimeRemaining(endtime);
        if (t.total <= 0) {
            clearInterval(timeinterval);
            t.hours = 0;
            t.minutes = 0;
            t.seconds = 0;
            clock.classList.remove('warning');
            clock.classList.add('stopped');
            stopHacking.classList.remove('hidden');
        }

        if (t.total > 0 && t.total < 900000) {
            clock.classList.add('warning');
        }

        if (t.total > 27000 && t.total <= 28000 && !audioStarted) {
            audioStarted = true;
            audio.play();
        }
        hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
    }

    var endtime = new Date(Date.parse('<?php echo $targetDateTime;?>'));
    var clock = document.getElementById('clockDisplay');
    var stopHacking = document.getElementById('stopHacking');
    var hoursSpan = clock.querySelector('.hours');
    var minutesSpan = clock.querySelector('.minutes');
    var secondsSpan = clock.querySelector('.seconds');
    var audio = new Audio('/audio/clock_countdown.mp3');
    var audioStarted = false;
    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
</script>
</html>