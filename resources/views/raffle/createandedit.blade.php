@extends('layouts.app')

@section('title', 'Crear Sorteo')

@section('title-icon', 'fas fa-gift')

@section('content')
    <form method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            <div class="col-lg-8">

                <div class="card shadow-sm">

                    <div class="card-body">

                        <div class="form-row">
                            
                            <x-input col="5" attr="title" :value="$raffle->title ?? ''" label="Título" description="Escribe un título para el sorteo (mínimo 5 caracteres)"/>
                            @error("title")
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <x-input col="5" attr="prize" :value="$raffle->prize ?? ''" label="Premio" description="Escribe el premio a sortear"/>
                            @error("prize")
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="event">Selecciona el evento donde se realizará el sorteo </label>
                            <select id="event" name="event">
                                @foreach ($events as $event)
                                    <option value="{{$event->id}}">
                                        {!! $event->name !!}
                                    </option>
                                @endforeach
                            </select>
                        
                            

                        </div>
                        <button type="submit" formaction="{{$route_publish}}" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Publicar Sorteo</button>
                    </div>
                </div>
            </div>
        </div>
@endsection
