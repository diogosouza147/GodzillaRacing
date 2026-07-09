@php $car = $car ?? null; @endphp

<div class="row g-3 mb-3">
    <div class="col-md-4">
        <label class="form-label">Placa *</label>
        <input type="text" name="plate" value="{{ old('plate', $car?->plate) }}" class="form-control text-uppercase" required maxlength="20">
    </div>
    <div class="col-md-4">
        <label class="form-label">Modelo *</label>
        <input type="text" name="model" value="{{ old('model', $car?->model) }}" class="form-control" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Marca</label>
        <input type="text" name="brand" value="{{ old('brand', $car?->brand) }}" class="form-control">
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-4">
        <label class="form-label">Cor</label>
        <input type="text" name="color" value="{{ old('color', $car?->color) }}" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label">Nome do Dono *</label>
        <input type="text" name="owner_name" value="{{ old('owner_name', $car?->owner_name) }}" class="form-control" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Telefone</label>
        <input type="text" name="owner_phone" value="{{ old('owner_phone', $car?->owner_phone) }}" class="form-control">
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-4">
        <label class="form-label">Discord</label>
        <input type="text" name="discord_id" value="{{ old('discord_id', $car?->discord_id) }}" class="form-control" placeholder="usuario#0000">
    </div>
    <div class="col-md-4">
        <label class="form-label">Status de Pagamento *</label>
        <select name="payment_status" class="form-select" required>
            <option value="pendente" @selected(old('payment_status', $car?->payment_status) === 'pendente')>Pendente</option>
            <option value="pago" @selected(old('payment_status', $car?->payment_status) === 'pago')>Pago</option>
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Valor Pago (R$)</label>
        <input type="number" step="0.01" min="0" name="payment_value" value="{{ old('payment_value', $car?->payment_value) }}" class="form-control">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Observações</label>
    <textarea name="notes" class="form-control" rows="3">{{ old('notes', $car?->notes) }}</textarea>
</div>
