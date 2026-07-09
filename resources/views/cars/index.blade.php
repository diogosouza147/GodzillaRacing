@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fa-solid fa-car-side"></i> Carros Cadastrados</h2>
    <a href="{{ route('cars.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Novo Carro
    </a>
</div>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2">
            <div class="col-md-5">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por placa, modelo ou dono...">
            </div>
            <div class="col-md-3">
                <select name="payment_status" class="form-select">
                    <option value="">Todos os status</option>
                    <option value="pago" @selected(request('payment_status') === 'pago')>Pago</option>
                    <option value="pendente" @selected(request('payment_status') === 'pendente')>Pendente</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary w-100"><i class="fa-solid fa-magnifying-glass"></i> Filtrar</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Placa</th>
                    <th>Modelo</th>
                    <th>Dono</th>
                    <th>Contato</th>
                    <th>Pagamento</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cars as $car)
                    <tr>
                        <td class="fw-bold">{{ $car->plate }}</td>
                        <td>{{ $car->model }} @if($car->color) <span class="text-muted">({{ $car->color }})</span> @endif</td>
                        <td>{{ $car->owner_name }}</td>
                        <td>
                            @if($car->owner_phone) <div><i class="fa-solid fa-phone"></i> {{ $car->owner_phone }}</div> @endif
                            @if($car->discord_id) <div><i class="fa-brands fa-discord"></i> {{ $car->discord_id }}</div> @endif
                        </td>
                        <td>
                            <form method="POST" action="{{ route('cars.toggle-payment', $car) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="badge border-0 badge-{{ $car->payment_status }} text-white" style="cursor:pointer;">
                                    {{ $car->payment_status === 'pago' ? 'Pago' : 'Pendente' }}
                                </button>
                            </form>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('cars.edit', $car) }}" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                            <form method="POST" action="{{ route('cars.destroy', $car) }}" class="d-inline" onsubmit="return confirm('Remover este carro?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Nenhum carro cadastrado ainda.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $cars->links() }}
</div>
@endsection
