<?php
//security
if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gennibit</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html,
        body,
        .wrapper {
            height: 100%;
        }

        html,
        body {
            padding: 0;
            margin: 0;
        }

        body {
            font: 1rem / 1.516 'Montserrat', Arial, sans-serif;
        }

        .wrapper {
            position: relative;
            background: url(<?php echo esc_url(ADE_COMING_SOON_PLUGIN_URL . '/assets/img/bg.jpg') ?>) no-repeat center center / cover;

            &:before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgb(33 33 33 / 67%);
            }
        }

        header,
        .content,
        footer {
            position: absolute;
        }

        header,
        footer {
            width: 100%;
        }

        header {
            top: 30px;
            text-align: center;
        }

        .header__logo {
            max-width: 65px;
            fill: #fff;
        }

        .content {
            top: 50%;
            left: 50%;
            text-align: center;
            color: #fff;
            transform: translate(-50%, -50%);

            h1 {
                margin-top: 0;
            }

            form {
                margin: auto;
                display: table;
            }

            input {
                float: left;
                font-size: 16px;
                border: 1px solid #fff;
            }

            input[type=email] {
                padding: 12px;
                background: #fff;
                border-top-left-radius: 4px;
                border-bottom-left-radius: 4px;
            }

            input[type=submit] {
                padding: 12px 24px;
                color: #fff;
                background: transparent;
                border-top-right-radius: 4px;
                border-bottom-right-radius: 4px;
                cursor: pointer;
                transition: all .235s ease-in-out;

                &:hover {
                    color: #212121;
                    background: #fff;
                }
            }
        }

        .countdown {
            margin: auto;
            display: table;
            font-size: 28px;
            font-weight: 500;

            >div {
                float: left;
                min-width: 80px;
            }

            span {
                position: relative;
                display: block;
                font-size: 16px;
                text-align: center;

                &:before {
                    content: '';
                    position: absolute;
                    top: -2px;
                    right: 0;
                    left: 0;
                    margin-right: auto;
                    margin-left: auto;
                    width: 20px;
                    height: 1px;
                    background: #fff;
                }
            }
        }

        footer {
            padding-bottom: 12px;
            bottom: 0;
        }

        .footer__links {
            text-align: center;
            list-style-type: none;

            li {
                display: inline-block;

                &:nth-of-type(n+2) {
                    margin-left: 12px;
                }
            }

            a {
                padding: 8px 0;
                display: block;
                width: 41px;
                text-align: center;
                color: #fff;
                border: 1px solid;
                border-radius: 50%;
                transition: opacity .235s ease-in-out;

                &:hover {
                    opacity: .5;
                }
            }

            .fa {
                vertical-align: middle;
                font-size: 21px;
            }
        }

        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            header {
                top: 60;
            }

            .countdown {
                font-size: 20px;
            }

            .countdown span {
                font-size: 12px;
            }

            h1 {
                font-size: 23px;
            }
        }

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            header {
                top: 60px;
            }

            .countdown {
                font-size: 20px;
            }

            h1 {
                font-size: 23px;
            }
        }

        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (min-width: 768px) {
            header {
                top: 100px;
            }

            .countdown {
                font-size: 20px;
            }

            .countdown span {
                font-size: 12px;
            }

            h1 {
                font-size: 25px;
            }
        }

        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 992px) {
            header {
                top: 150px;
            }

            .countdown {
                font-size: 28px;
            }

            .countdown span {
                font-size: 16px;
            }

            h1 {
                font-size: 30px;
            }
        }

        /* Extra large devices (large laptops and desktops, 1200px and up) */
        @media only screen and (min-width: 1200px) {
            header {
                top: 150px;
            }

            .countdown {
                font-size: 28px;
            }

            .countdown span {
                font-size: 16px;
            }

            h1 {
                font-size: 40px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <header>
            <img class="header__logo" src="http://localhost:8888/gennibit/wp-content/uploads/2023/12/fav-icon.png" alt="">
        </header>

        <main class="content">
            <h1>Our Website is Launching soon</h1>

            <div class="countdown">
                <div class="countdown__days">
                    <div class="number"></div>
                    <span class>Days</span>
                </div>

                <div class="countdown__hours">
                    <div class="number"></div>
                    <span class>Hours</span>
                </div>

                <div class="countdown__minutes">
                    <div class="number"></div>
                    <span class>Minutes</span>
                </div>

                <div class="countdown__seconds">
                    <div class="number"></div>
                    <span class>Seconds</span>
                </div>
            </div>

            <p>
                We are currently tidying things up and gearing up to launching the best EdTech platform that will revolutionise learning for everyone.
            </p>
        </main>

        <footer>
            <ul class="footer__links">
                <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                <li><a href="#"><span class="fa fa-github"></span></a></li>
                <li><a href="#"><span class="fa fa-dribbble"></span></a></li>
            </ul>
        </footer>
    </div>
    <script>
        (() => {
            // Specify the deadline date
            const deadlineDate = new Date('January 01, 2024 00:00:00').getTime();

            // Cache all countdown boxes into consts
            const countdownDays = document.querySelector('.countdown__days .number');
            const countdownHours = document.querySelector('.countdown__hours .number');
            const countdownMinutes = document.querySelector('.countdown__minutes .number');
            const countdownSeconds = document.querySelector('.countdown__seconds .number');

            // Update the count down every 1 second (1000 milliseconds)
            setInterval(() => {
                // Get current date and time
                const currentDate = new Date().getTime();

                // Calculate the distance between current date and time and the deadline date and time
                const distance = deadlineDate - currentDate;

                // Calculations the data for remaining days, hours, minutes and seconds
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Insert the result data into individual countdown boxes
                countdownDays.innerHTML = days;
                countdownHours.innerHTML = hours;
                countdownMinutes.innerHTML = minutes;
                countdownSeconds.innerHTML = seconds;
            }, 1000);
        })();
    </script>
</body>

</html>