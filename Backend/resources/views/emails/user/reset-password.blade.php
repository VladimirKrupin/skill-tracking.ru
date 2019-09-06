<!doctype html>
<html lang="{{App::getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>
    <!-- Fonts -->
</head>
<body>
<p>{{__('forgot.reset_text')}}</p>
<p>{{__('forgot.password')}} {{$mailData['pass']}}</p>
</body>
</html>
