@extends('layouts.app')

@section('title', 'Sorteos')
@section('title-icon', 'fas fa-gift')

@section('content')
    <div class="row">
            <div class="col-lg-8">

                <div class="card shadow-lg">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataset" class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">ID</th>
                                        <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">Sorteo</th>
                                        <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">Premio</th>
                                        <th class="d-none d-sm-none d-md-table-cell d-lg-table-cell">Ganador</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($raffles as $raffle)
                                        <tr>
                                        <td class="d-none d-sm-none d-md-table-cell d-lg-table-cell">{{$raffle->id}}</td>
                                        <td><a href="{{route('raffle.view',['raffle' => $raffle, 'id' => $raffle->id])}}">{{$raffle->title}}</a></td>
                                        <td class="d-none d-sm-none d-md-table-cell d-lg-table-cell">{{$raffle->prize}}</td>
                                        <td class="d-none d-sm-none d-md-table-cell d-lg-table-cell">{{$raffle->winner}}</td>
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