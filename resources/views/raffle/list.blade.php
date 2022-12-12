@extends('layouts.app')

@section('title', 'Sorteos')
@section('title-icon', 'fas fa-gift')

@section('content')
    <div class="row">
            <div class="col-lg-8">
                <div class="form-group col-lg-6">
                    <a href="{{route('raffle.createandedit',\Instantiation::instance())}}"><i class="fas fa-gift"></i>Crear un nuevo Sorteo</a>
                </div>
                <div class="card shadow-lg">

                <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataset" class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">ID</th>
                                        <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">Sorteo</th>
                                        <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">Evento</th>
                                        <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">Premio</th>
                                        <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">Ganador</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($raffles as $raffle)
                                        <tr>
                                        <td class="d-none d-sm-none d-md-table-cell d-lg-table-cell">{{$raffle->id}}</td>
                                        <td><a href="{{route('raffle.view',['id' => $raffle->id, 'instance' => \Instantiation::instance()])}}">{{$raffle->title}}</a></td>
                                        <td class="d-none d-sm-none d-md-table-cell d-lg-table-cell">{{$raffle->event->name}}</td>
                                        <td class="d-none d-sm-none d-md-table-cell d-lg-table-cell">{{$raffle->prize}}</td>
                                        @isset($raffle->winner)
                                        <td class="d-none d-sm-none d-md-table-cell d-lg-table-cell">{{$raffle->winner->name}} {{$raffle->winner->surname}}</td>
                                        @else
                                        <td class="d-none d-sm-none d-md-table-cell d-lg-table-cell">No hay ganador todavía</td>
                                        @endisset
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection