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
<p>{{__('change.text')}}</p>
<br>
<hr>
<p>{{__('change.warning')}} <a href="{{$mailData['host']}}/#/forgot?hash={{$mailData['hash']}}">{{__('change.warning_link')}}</a></p>
</body>
</html>
