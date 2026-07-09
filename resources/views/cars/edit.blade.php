@extends('layouts.app')

@section('content')
<h2 class="mb-4"><i class="fa-solid fa-pen"></i> Editar Carro</h2>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('cars.update', $car) }}">
            @csrf
            @method('PUT')
            @include('cars._form', ['car' => $car])
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i> Salvar</button>
            <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
