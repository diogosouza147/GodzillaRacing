@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fa-solid fa-calendar-days"></i> Eventos</h2>
    <a href="{{ route('events.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Novo Evento
    </a>
</div>

<div class="row g-3">
    @forelse ($events as $event)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $event->name }}</h5>
                    <p class="text-muted mb-1"><i class="fa-solid fa-clock"></i> {{ $event->event_date->format('d/m/Y H:i') }}</p>
                    @if($event->location)
                        <p class="text-muted mb-2"><i class="fa-solid fa-location-dot"></i> {{ $event->location }}</p>
                    @endif
                    <p class="mb-3">
                        <span class="badge bg-primary"><i class="fa-solid fa-car"></i> {{ $event->cars_count }} carro(s) inscrito(s)</span>
                    </p>
                    <div class="mt-auto d-flex gap-2">
                        <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-primary flex-fill">Ver detalhes</a>
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                        <form method="POST" action="{{ route('events.destroy', $event) }}" onsubmit="return confirm('Remover este evento?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">Nenhum evento cadastrado ainda.</div>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $events->links() }}
</div>
@endsection
