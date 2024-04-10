@extends('frontend.Default.layouts.app')

@section('page-title', 'Список игр')

@section('content')
<main class="index">
    <div class="categories">
        <div class="container">
            <nav>
                <a href="/all" class="categories__main">Все игры</a>
                @if ($categories && count($categories))
                    @foreach($categories AS $index=>$category)
                        <a href="{{ route('frontend.game.list.category', $category->href) }}" class="@if($currentSliderNum != -1 && $currentSliderNum == $category->href) active @endif">{{ $category->title }}</a>
                    @endforeach
                @endif
            </nav>
        </div>
    </div>
    <div class="games">
        <div class="container">
            <div class="games__rows">
                @if ($games && count($games))
                    @foreach ($games as $key=>$game)
                    <a href="{{ route('frontend.game.go', $game['name']) }}?api_exit=/" class="games__item">
                        <div class="games__item-img">
                            <img src="{{ $game->name ? '/frontend/Default/ico/' . $game->name . '.jpg' : '' }}" alt="{{ $game->title }}">
                            <div class="games__item-play">Играть</div>
                        </div>
                        <div class="games__item-title">{{ $game->title }}</div>
                    </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</main>
<footer class="footer">
    <div class="container">
        <div class="footer__row">
            <div class="footer__text">
                №{{ explode("_", auth()->user()->username)[0] }}
            </div>
            <div class="footer__balance">
                @if (auth()->user()->balance > 0)
                <span>Баланс:</span> {{ number_format(auth()->user()->balance, 2, '.', '') }} &#8381;
                @else
                <span style="font-size: 0.7em">Пополните баланс у администратора</span>
                @endif
            </div>
        </div>
    </div>
</footer>
@stop
