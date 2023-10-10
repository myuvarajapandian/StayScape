<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to StayScape</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            background-image: url('https://www.creativefabrica.com/wp-content/uploads/2020/04/09/Night-city-background-with-many-building-Graphics-3832790-1.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .welcome-container {
            padding: 100px 0;
            text-align: center;
        }

        .welcome-card {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="container-fluid welcome-container position-fixed mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="welcome-card">
                    <h1 class="display-4 mb-5">Welcome to StayScape</h1>
                    <p class="lead">Your go-to platform for hassle-free accommodation booking and hosting.</p>
                    <p>Discover and book the perfect place to stay for your next trip. Whether it's a cozy apartment in the city or a beachfront villa, StayScape has you covered.</p>
                    <p>Are you a property owner? List your space with us and start earning today. Join our community of hosts and offer travelers a unique place to call home.</p>
                    <div class="text-center mt-5">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg mr-3 m">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-success btn-lg">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>