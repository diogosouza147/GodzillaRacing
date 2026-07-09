@extends('layouts.app')

@section('content')
<h2 class="mb-4"><i class="fa-solid fa-plus"></i> Novo Carro</h2>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('cars.store') }}">
            @csrf
            @include('cars._form')
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check"></i> Cadastrar</button>
            <a href="{{ route('cars.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
