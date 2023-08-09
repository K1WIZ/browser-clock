<!DOCTYPE html>
<html>
<head>
    <title>Network Time Clock</title>
    <style>
        @font-face {
            font-family: 'LED';
            src: url('led.ttf') format('truetype');
            /* Add other font properties here if needed */
        }

        body {
            margin: 0;
            padding: 0;
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'LED', Arial, sans-serif;
        }

        #clock {
            font-size: 25vw;
            font-weight: ;
            color: red;
            text-align: center;
        }
    </style>
    <script>
        function updateClock(serverTime) {
            var currentTime = new Date(serverTime);
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();
            var meridiem = "AM";

            if (hours > 12) {
                hours -= 12;
                meridiem = "PM";
            }

            if (hours === 0) {
                hours = 12;
            }

            if (minutes < 10) {
                minutes = "0" + minutes;
            }

            if (seconds < 10) {
                seconds = "0" + seconds;
            }

            var timeString = hours + ":" + minutes + /*":" + seconds + */" " + meridiem;
            document.getElementById("clock").textContent = timeString;
        }

        setInterval(function() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    updateClock(xhr.responseText);
                }
            };
            xhr.open("GET", "getservertime.php", true);
            xhr.send();
        }, 1000);
    </script>
</head>
<body>
    <div id="clock"></div>
</body>
</html>
