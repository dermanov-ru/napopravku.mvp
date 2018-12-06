@extends('layouts.app')

@push('scripts')
    <script type="text/javascript" src="{{ asset ('js/doctor.vue.js') }}"></script>

    <script>
        let doctorApp = new DoctorApp({!! $doctor->toJson(JSON_NUMERIC_CHECK) !!});
    </script>
@endpush

@section('content')
<div class="container" id="doctor_app">
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
                    <form action="{{ url('order') }}" method="post" id="order_form" @submit.prevent="order">
                        @csrf
                        <input type="hidden" v-model="selected_slot.id" name="slot_id">
                        <input type="hidden" value="{{ $doctor->id }}" name="doctor_id">

                        <h5 class="mb-3">Выберите дату и время приёма</h5>
                        <div class="form-group">
                            <div class="row slots">

                                <template v-for="(slots, date, index) in doctor.slots_by_date">
                                    <div class="col-xs-12 col-sm-2 text-center mb-3">
                                        <div class="date">@{{  date }}</div>

                                        <template v-for="slot in slots">
                                            <div :class="['slot', { 'free' : slot.is_free }, { 'selected' : selected_slot == slot }]" @click="select_slot(slot)">
                                                @{{ slot.is_free ? slot.time : " - " }}
                                            </div>
                                        </template>
                                    </div>
                                </template>

                            </div>
                        </div>


                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Дата и время*" readonly :value="selected_datetime">
                            <small class="form-text text-muted">Выберите дату и время в таблице</small>
                        </div>

                        <div class="form-group">
                            <select class="form-control" required name="service_id">
                                <option value="">- Выбрать услугу -</option>

                                @foreach ($doctor->services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->pivot->price }} руб.)</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Записаться</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
