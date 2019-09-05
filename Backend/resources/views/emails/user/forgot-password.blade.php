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
<p>{{__('forgot.text')}} <a href="{{$mailData['host']}}/#/forgot#{{$mailData['hash']}}">{{__('forgot.link')}}</a></p>


</body>
</html>
