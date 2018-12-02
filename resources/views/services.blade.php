@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-2">Услуги</h2>

    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Услуги</li>
        </ol>
    </nav>


    <div class="row">
        @foreach ($services as $service)
            <div class="col-md-4 mb-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $service->name  }}</h5>
                    </div>

                    <ul class="list-group list-group-flush">
                        @if (count($service->doctors))
                            @foreach ($service->doctors as $doctor)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-4 mr-2">
                                            <a href="{{ route('doctor', $doctor->id) }}" class="card-link" title="Записаться на приём">
                                                <img class="card-img-top" src="{{ $doctor->photo_url  }}" style="width: 50px;">
                                            </a>
                                        </div>
                                        <div class="col-xs-8">
                                            <a href="{{ route('doctor', $doctor->id) }}" class="card-link" title="Записаться на приём">{{ $doctor->name }}</a>
                                            <div>{{ $doctor->pivot->price }} руб.</div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">Нет врачей с этой услугой</li>
                        @endif
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
