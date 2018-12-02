@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-2">Врачи</h2>

    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Врачи</li>
        </ol>
    </nav>

    <div class="row">
        @foreach ($doctors as $doctor)
            <div class="col-md-4 mb-5">
                <div class="card">
                    <a href="{{ route('doctor', $doctor->id) }}" class="card-link" >
                        <img class="card-img-top" src="{{ $doctor->photo_url  }}">
                    </a>

                    <div class="card-body">
                        <h5 class="card-title">{{ $doctor->name  }}</h5>
                        <p class="card-text">Стаж {{ $doctor->exp_years  }}+ лет</p>
                    </div>

                    <ul class="list-group list-group-flush">
                        @foreach ($doctor->services as $service)
                            <li class="list-group-item">{{ $service->name }} - {{ $service->pivot->price }} руб.</li>
                        @endforeach
                    </ul>

                    <div class="card-body">
                        <a href="{{ route('doctor', $doctor->id) }}" class="card-link">Записаться на приём</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
