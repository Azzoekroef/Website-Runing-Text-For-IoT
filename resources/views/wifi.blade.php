<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wi-Fi Configuration</title>
    <style>
        /* Basic page styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        /* Centering the form */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Form styling */
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Responsive design for small screens */
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
                width: 100%;
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Configure Wi-Fi</h1>
            <form action="{{ route('wifi-config') }}" method="POST">
                @csrf
                <label for="ssid">SSID:</label>
                <!-- Jika data SSID ada, tampilkan di input field -->
                <input type="text" id="ssid" name="ssid" value="{{ $wifiConfig->ssid ?? '' }}" required><br><br>

                <label for="password">Password:</label>
                <!-- Jika data password ada, tampilkan di input field -->
                <input type="text" id="password" name="password" value="{{ $wifiConfig->password ?? '' }}" required><br><br>

                <button type="submit">Save Configuration</button>
            </form>
        </div>
    </div>
</body>
</html>