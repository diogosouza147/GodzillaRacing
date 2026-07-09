@extends('layouts.app')

@section('content')
<h2 class="mb-4"><i class="fa-solid fa-pen"></i> Editar Evento</h2>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('events.update', $event) }}">
            @csrf
            @method('PUT')
            @include('events._form', ['event' => $event])
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i> Salvar</button>
            <a href="{{ route('events.show', $event) }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
