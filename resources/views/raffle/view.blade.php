@extends('layouts.app')

@section('title', 'Ver sorteo: '.$raffle->title)

@section('title-icon', 'fas fa-gift')

@section('breadcrumb')

    <li class="breadcrumb-item"><a href="{{route('raffle.list',$instance)}}">Todos los sorteos</a></li>

    <li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow-lg">

                <div class="card-body">
                    <label for="title">Título</label>
                    <h4>{{$raffle->title}}</h4>
                    <label for="prize">Premio</label>
                    <h4>{{$raffle->prize}}</h4>
                    <label for="winner">Ganador</label>
                    @isset($raffle->winner_id)
                        <h4>{{$raffle->winner->name}} {{$raffle->winner->surname}}</h4>
                        @else
                        <h4>No hay ganador todavía</h4>
                        <a href="{{route('raffle.raffle',['id' => $raffle->id, 'instance' => \Instantiation::instance()])}}">Sortear</a>
                    @endisset

                </div>

            </div>

        </div>


    </div>


@endsection
