@extends('frontend.Default.layouts.app')

@section('page-title', 'Авторизация')

@section('content')
<main class="login">
    <div class="container">
        <div class="login__wrap">
            <div class="login__form">
                <div class="login__title">Авторизация</div>
                @include('frontend.Default.partials.messages')
                <form action="<?= route('frontend.auth.login.post') ?>" method="POST">
                    <input type="hidden" value="<?= csrf_token() ?>" name="_token">
                    <input type="text" name="username" placeholder="Имя пользователя">
                    <input type="password" name="password" placeholder="Пароль">
                    <button class="btn">Войти</button>
                </form>
            </div>
        </div>
    </div>
</main>
@stop