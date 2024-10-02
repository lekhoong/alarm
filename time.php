<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Alarm Clock with Auto-Close Alert</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        #clock-container {
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #ff6347;
        }

        #inputalarm {
            width: 200px;
            padding: 10px;
            font-size: 1rem;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        button {
            background-color: #ff6347;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e5533d;
        }

        #alarmsound {
            display: none;
        }

        #custom-alert {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 999;
        }

        #custom-alert p {
            margin: 0;
            padding: 10px;
            font-size: 1.2rem;
            color: #333;
        }

        @media screen and (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }

            button {
                padding: 10px;
                font-size: 0.9rem;
            }

            #inputalarm {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div id="clock-container">
        <h1 id="time"></h1>
        <input type="time" id="inputalarm">
        <button onclick="alarm()">Set Alarm</button>
        <audio id="alarmsound">
            <source src="After Like.mp3" type="audio/mpeg">
        </audio>
    </div>


    <div id="custom-alert">
        <p id="alert-message"></p>
    </div>

    <script>
     
        function updateClock() {
            const date = new Date();
            const hour = String(date.getHours()).padStart(2, '0');
            const minute = String(date.getMinutes()).padStart(2, '0');
            const sec = String(date.getSeconds()).padStart(2, '0');

            document.getElementById('time').innerHTML = `${hour}:${minute}:${sec}`;
            setTimeout(updateClock, 1000);
        }

        updateClock();

        
        function alarm() {
            let alarminput = document.getElementById("inputalarm").value;

            if (!alarminput) {
                showAlert("Please set a valid alarm time.");
                return;
            }

            let alarmtime = new Date();
            let parts = alarminput.split(":");

            alarmtime.setHours(parseInt(parts[0], 10));
            alarmtime.setMinutes(parseInt(parts[1], 10));
            alarmtime.setSeconds(0);

            let currenttime = new Date();
            let timeuntilalarm = alarmtime - currenttime;

            if (timeuntilalarm <= 0) {
                showAlert("Alarm time must be in the future.");
                return;
            }

            showAlert(`Alarm set for ${alarminput}.`);

            setTimeout(function () {
                playAlarmsound();
            }, timeuntilalarm);
        }

        function playAlarmsound() {
            let sound = document.getElementById("alarmsound");
            sound.play();
        }

        function showAlert(message) {
            let alertBox = document.getElementById("custom-alert");
            let alertMessage = document.getElementById("alert-message");

            alertMessage.innerHTML = message;
            alertBox.style.display = "block";

            setTimeout(function() {
                alertBox.style.display = "none";
            }, 2000);  
        }
    </script>
</body>
</html>
