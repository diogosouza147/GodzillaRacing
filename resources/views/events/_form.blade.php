@php $event = $event ?? null; @endphp

<div class="mb-3">
    <label class="form-label">Nome do Evento *</label>
    <input type="text" name="name" value="{{ old('name', $event?->name) }}" class="form-control" required>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label">Data e Hora *</label>
        <input type="datetime-local" name="event_date" value="{{ old('event_date', $event?->event_date?->format('Y-m-d\TH:i')) }}" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Local</label>
        <input type="text" name="location" value="{{ old('location', $event?->location) }}" class="form-control">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Descrição</label>
    <textarea name="description" class="form-control" rows="3">{{ old('description', $event?->description) }}</textarea>
</div>
