<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thank You {{ auth()->user()->name }}</title>
    <!-- meta data -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <!-- HTML Meta Tags -->
    <meta name="title" content="Title">
    <meta name="keywords" content="Keyword here">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="Munna Patel">
    <meta name="description" content="description">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="title">
    <meta property="og:image" content="{{ url('/') }}/image.jpg">
    <meta property="og:site_name" content="domain">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="title">
    <meta property="twitter:description" content="description">
    <meta property="twitter:image" content="{{ url('/') }}/image.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            min-height: 70vh;
            background: #335991;
            overflow: hidden;
        }

        .glowing {
            position: absolute;
            min-width: 700px;
            height: 550px;
            margin: -150px;
            transform-origin: right;
            animation: colorChange 5s linear infinite;
        }

        .glowing:nth-child(even) {
            transform-origin: left;
        }

        @keyframes colorChange {
            0% {
                filter: hue-rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                filter: hue-rotate(360deg);
                transform: rotate(360deg);
            }
        }

        .glowing span {
            position: absolute;
            top: calc(80px * var(--i));
            left: calc(80px * var(--i));
            bottom: calc(80px * var(--i));
            right: calc(80px * var(--i));
        }

        .glowing span::before {
            content: "";
            position: absolute;
            top: 50%;
            left: -8px;
            width: 15px;
            height: 15px;
            background: #f00;
            border-radius: 50%;
        }

        .glowing span:nth-child(3n + 1)::before {
            background: rgba(134, 255, 0, 1);
            box-shadow: 0 0 20px rgba(134, 255, 0, 1),
                0 0 40px rgba(134, 255, 0, 1),
                0 0 60px rgba(134, 255, 0, 1),
                0 0 80px rgba(134, 255, 0, 1),
                0 0 0 8px rgba(134, 255, 0, .1);
        }

        .glowing span:nth-child(3n + 2)::before {
            background: rgba(255, 214, 0, 1);
            box-shadow: 0 0 20px rgba(255, 214, 0, 1),
                0 0 40px rgba(255, 214, 0, 1),
                0 0 60px rgba(255, 214, 0, 1),
                0 0 80px rgba(255, 214, 0, 1),
                0 0 0 8px rgba(255, 214, 0, .1);
        }

        .glowing span:nth-child(3n + 3)::before {
            background: rgba(0, 226, 255, 1);
            box-shadow: 0 0 20px rgba(0, 226, 255, 1),
                0 0 40px rgba(0, 226, 255, 1),
                0 0 60px rgba(0, 226, 255, 1),
                0 0 80px rgba(0, 226, 255, 1),
                0 0 0 8px rgba(0, 226, 255, .1);
        }

        .glowing span:nth-child(3n + 1) {
            animation: animate 10s alternate infinite;
        }

        .glowing span:nth-child(3n + 2) {
            animation: animate-reverse 3s alternate infinite;
        }

        .glowing span:nth-child(3n + 3) {
            animation: animate 8s alternate infinite;
        }

        @keyframes animate {
            0% {
                transform: rotate(180deg);
            }

            50% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes animate-reverse {
            0% {
                transform: rotate(360deg);
            }

            50% {
                transform: rotate(180deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid text-light">
        <div class="d-flex justify-content-center">
            <div class="col-sm-6">
                <h2 class="mt-3 mb-3 text-danger">Hi {{ auth()->user()->name }} </h2>

                <h3>Thanks for being awesome!</h3>
                <h5>Your application ID is @if ($application_id) {{$application_id}} @endif</h5>
                <p>Thanks for contacting us! We will be in touch with you shortly.</p>
                <h4 class="mt-5">Warm Regards,</h4>
                <h5>{{ url('') }}</h3>
            </div>
        </div>
    </div>

    <div class="glowing">

        <span style="--i:1;"></span>

        <span style="--i:2;"></span>

        <span style="--i:3;"></span>

    </div>

    <div class="glowing">

        <span style="--i:1;"></span>

        <span style="--i:2;"></span>

        <span style="--i:3;"></span>

    </div>

    <div class="glowing">

        <span style="--i:1;"></span>

        <span style="--i:2;"></span>

        <span style="--i:3;"></span>

    </div>

    <div class="glowing">

        <span style="--i:1;"></span>

        <span style="--i:2;"></span>

        <span style="--i:3;"></span>

    </div>


    <script>
        $(document).ready(function() {
            setTimeout(function() {
                window.location = '/';
            }, 10000)
        })
    </script>
</body>

</html>
