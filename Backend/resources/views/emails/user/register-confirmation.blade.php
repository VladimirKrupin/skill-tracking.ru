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
<p>{{__('register.confirmation_text')}} <a href="{{$mailData['host']}}/#/register#{{$mailData['hash']}}">{{__('register.confirmation_link')}}</a></p>
</body>
</html>
