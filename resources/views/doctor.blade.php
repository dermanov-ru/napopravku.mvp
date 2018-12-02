@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-2">{{ $doctor->name }}</h2>

    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <li class="breadcrumb-item" ><a href="{{ route('doctors') }}">Врачи</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $doctor->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-4 mb-5">
            <div class="card">
                <img class="card-img-top" src="{{ $doctor->photo_url  }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $doctor->name  }}</h5>
                    <p class="card-text">Стаж {{ $doctor->exp_years  }}+ лет</p>
                </div>

                <ul class="list-group list-group-flush">
                    @foreach ($doctor->services as $service)
                        <li class="list-group-item">{{ $service->name }} - {{ $service->pivot->price }} руб.</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="col-md-8 mb-5">
            <h3>Запись на прием</h3>

            <div class="card">
                <div class="card-body">
                    <form>

                        <h5 class="mb-3">Выберите дату и время приёма</h5>
                        <div class="form-group">
                            <div class="row slots">

                                @foreach ($doctor->slotsByDate() as $date => $slots)
                                    <div class="col-xs-12 col-sm-2 text-center mb-3">
                                        <div class="date">{{  $date }}</div>

                                        @foreach ($slots as $slot)
                                            @if ($slot->is_free)
                                                <div class="slot free">{{ $slot->time() }}</div>
                                            @else
                                                <div class="slot"> - </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach


                            </div>
                        </div>


                        <div class="form-group">
                            <select class="form-control" required>
                                <option value="">- Выбрать услугу -</option>

                                @foreach ($doctor->services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->pivot->price }} руб.)</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Номер телефона*" required>
                            <small class="form-text text-muted">На этот номер придет смс для подтверждения</small>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" placeholder="Вы можете указать, к какому врачу, на какое время или с каким вопросом" rows="3" cols="80" required="required">Запись на прием</textarea>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" required>
                            <label class="form-check-label" for="exampleCheck1">Согласен с условиями</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Записаться</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
