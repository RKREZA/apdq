<!DOCTYPE html>
<html>
<head>
  <title>Message from actualitepolitiqueduquebec.com</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f5f5f5;
    }
    .container {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    h1 {
      color: #333;
      font-size: 20px;
    }
    p {
      font-size: 16px;
      color: #666;
    }
    a {
      color: #007bff;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="{{ asset('assets/frontend/img/logo.webp') }}" alt="Actualité politique du Québec logo" style="width: 60px;" />
    <h1>Inscription réussie!</h1>
    <p>{{ $data['message'] }}</p>
    <p style="font-size: 0.8em; text-align: center;">
      <a href="https://www.actualitepolitiqueduquebec.com/" target="_blank">actualitepolitiqueduquebec.com</a>
    </p>
  </div>
</body>
</html>
