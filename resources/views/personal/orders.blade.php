@extends('layouts.app')

@section('content')
<div class="container" id="doctor_app">
    <h2 class="mb-2">Моя запись</h2>

    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <li class="breadcrumb-item" >Личный кабинет</li>
            <li class="breadcrumb-item active" aria-current="page">Моя запись</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-4 mb-5">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Меню</strong></li>
                    <li class="list-group-item"><a href="{{ route("my_orders") }}">Моя запись</a></li>
                    <li class="list-group-item"><a href="{{ route("doctors") }}">Найти врача</a></li>
                    <li class="list-group-item"><a href="{{ route("services") }}">Найти услугу</a></li>
                    <li class="list-group-item">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Выход
                        </a>
                    </li>
                </ul>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <div class="col-md-8 mb-5">
            <h3>Запись на прием</h3>

            <div class="alert alert-success">
                Для упрощения, список содержит только предстоящие визиты.
            </div>

            @if (!$orders->count())
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="text-center">Вы еще никуда не записались :)</div>
                    </div>
                </div>
            @endif

            @foreach ($orders as $order)

            <div class="card mb-4">
                <div class="card-body">
                    <div >Дата и время: {{ $order->datetime }}</div>
                    <div >Врач: <a target="_blank" href="{{ route("doctor", $order->doctor->id ) }}">{{ $order->doctor->name }}</a></div>
                    <div >Услуга: {{ $order->service->name }}</div>
                    <div >Стоимость: {{ $order->price }} руб.</div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
