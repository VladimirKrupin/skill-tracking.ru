<!doctype html>
<html lang="{{App::getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{__('register.mail_title')}}</title>
    <!-- Fonts -->
</head>
<body>
<h1>{{__('register.register_success')}}</h1>
<p>
    <b>{{__('register.login')}}</b> - {{$login}}
</p>
<p>
    <b>{{__('register.password')}}</b> - {{$password}}
</p>
</body>
</html>
