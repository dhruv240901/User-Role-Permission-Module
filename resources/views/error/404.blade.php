<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            font-size: 10em;
            margin: 0;
            color: #555;
        }

        p {
            font-size: 1.5em;
            color: #777;
        }

        a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>404</h1>
        <p>Page Not Found</p>
        <p>Sorry, the page you are looking for might be in another castle.</p>
        <p>Go back to <a href="{{ route('index') }}">home</a>.</p>
    </div>
</body>

</html>
