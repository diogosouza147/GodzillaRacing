@extends('layouts.app')

@section('content')
<h2 class="mb-4"><i class="fa-solid fa-plus"></i> Novo Evento</h2>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('events.store') }}">
            @csrf
            @include('events._form')
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i> Criar Evento</button>
            <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
