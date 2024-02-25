<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>À venir en direct!</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #fff;
    }
    .container {
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .header {
      display: flex;
      /* align-items: center; */
      margin-bottom: 20px;
      flex-direction: column;
    }
    .logo {
      width: 60px;
      display: block;
    }
    h1 {
      color: #333;
      font-size: 24px;
      margin-top: 0;
      /* margin-left: 20px; */
    }
    p {
      font-size: 16px;
      color: #666;
      line-height: 1.5;
    }
    a {
      color: #007bff;
      text-decoration: none;
      font-weight: bold;
    }
    .event-image {
      display: block;
      width: 100%;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="https://actualitepolitiqueduquebec.productionjasmindupaul.com/assets/frontend/img/logo.webp" alt="Actualité politique du Québec logo" class="logo" /><br>
    </div>

    <h1>À venir en direct!</h1>

    <p>Cher abonné,</p>
    <p>
      Nous avons un événement en direct à venir intitulé "<strong>{{ $liveEvent->title }}</strong>" que vous ne voudrez pas manquer !
    </p>
    <img src="{{ $liveEvent->thumbnail_url }}" alt="{{ $liveEvent->title }} image" class="event-image" />
    <p>
      <b>Date et heure :</b> {{ $liveEvent->created_at->format('d F Y à H:i') }}
    </p>
    <p>
      <b>Rejoignez-nous sur :</b> <a href="{{ route('frontend.live') }}">{{ route('frontend.live') }}</a>
    </p>
    <p>Merci de rester avec nous,</p>
  </div>
</body>
</html>
