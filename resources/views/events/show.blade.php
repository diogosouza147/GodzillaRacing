@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h2>{{ $event->name }}</h2>
        <p class="text-muted mb-0"><i class="fa-solid fa-clock"></i> {{ $event->event_date->format('d/m/Y H:i') }}</p>
        @if($event->location)
            <p class="text-muted"><i class="fa-solid fa-location-dot"></i> {{ $event->location }}</p>
        @endif
        @if($event->description)
            <p>{{ $event->description }}</p>
        @endif
    </div>
    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fa-solid fa-arrow-left"></i> Voltar
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white">
                <strong><i class="fa-solid fa-car"></i> Carros Inscritos ({{ $event->cars->count() }})</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Placa</th>
                            <th>Modelo</th>
                            <th>Dono</th>
                            <th>Pagamento (evento)</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($event->cars as $car)
                            <tr>
                                <td class="fw-bold">{{ $car->plate }}</td>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->owner_name }}</td>
                                <td>
                                    <form method="POST" action="{{ route('events.cars.toggle-payment', [$event, $car]) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="badge border-0 badge-{{ $car->pivot->payment_status }} text-white" style="cursor:pointer;">
                                            {{ $car->pivot->payment_status === 'pago' ? 'Pago' : 'Pendente' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="text-end">
                                    <form method="POST" action="{{ route('events.cars.remove', [$event, $car]) }}" onsubmit="return confirm('Remover carro do evento?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-xmark"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">Nenhum carro inscrito ainda.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-white">
                <strong><i class="fa-solid fa-plus"></i> Adicionar Carro ao Evento</strong>
            </div>
            <div class="card-body">
                @if($availableCars->isEmpty())
                    <p class="text-muted mb-0">Todos os carros cadastrados já estão neste evento.</p>
                @else
                    <form method="POST" action="{{ route('events.cars.add', $event) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Carro</label>
                            <select name="car_id" class="form-select" required>
                                <option value="">Selecione...</option>
                                @foreach ($availableCars as $car)
                                    <option value="{{ $car->id }}">{{ $car->plate }} - {{ $car->owner_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status de Pagamento</label>
                            <select name="payment_status" class="form-select" required>
                                <option value="pendente">Pendente</option>
                                <option value="pago">Pago</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Valor (R$)</label>
                            <input type="number" step="0.01" min="0" name="payment_value" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-check"></i> Inscrever Carro</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
