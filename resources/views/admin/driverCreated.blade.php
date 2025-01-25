<!-- SuccessController (Blade) -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Created - Business Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #4CAF50;
            font-size: 2em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1em;
            color: #555;
            margin-bottom: 30px;
        }

        .business-name {
            font-weight: bold;
            color: #007bff;
        }

        .qr-code {
            margin: 30px 0;
        }

        .button {
            background-color: #007bff;
            color: white;
            font-size: 1.1em;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .footer {
            font-size: 0.9em;
            color: #888;
            margin-top: 30px;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Congratulations!</h1>
        <p>Your account, <span class="business-name">{{$user->name}}</span>, has been successfully created.</p>
        <p>Our team will now verify your driver information. We will notify you once your account has been approved and is ready to use.</p>


        <!-- Navigate Back Button -->
        <a href="{{ route('index') }}" class="button">Go Back to Homepage</a>

        <div class="footer">
            <p>If you have any questions, feel free to <a href="mailto:support@example.com">contact us</a>.</p>
        </div>
    </div>
</body>

</html>