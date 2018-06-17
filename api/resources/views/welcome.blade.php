@extends('layout')

@section('content')
	<div class="container container--style">
		{{--<div class="text text--label">Skill Tracking</div>--}}
		<div class="text text--header">Select language</div>
		<div class="click-hand click-hand--style">
			<div class="click-hand__img"></div>
		</div>
		<div class="image-container image-container--style">
			<div class="image-container__box">
				<img onclick="setCoockieAndRedirect('en')" class="image-container__img" src="{{ URL::asset('src/img/lang/en.svg') }}" alt="English language">
			</div>
			<div class="image-container__box">
				<img onclick="setCoockieAndRedirect('ru')" class="image-container__img" src="{{ URL::asset('src/img/lang/ru.svg') }}" alt="Русский язык">
			</div>
		</div>
	</div>
@stop

