@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Меню</div>

                    <div class="card-body">
                        <ul>
                            <li><a href="{{ route('doctors') }}">Врачи</a></li>
                            <li><a href="{{ route('services') }}">Услуги</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
