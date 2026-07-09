@extends('layouts.app')

@section('content')
<h2 class="mb-4">Dashboard</h2>
<div class="row g-3">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fa-solid fa-car fa-2x text-primary mb-2"></i>
                <h3>{{ \App\Models\Car::count() }}</h3>
                <p class="text-muted mb-0">Carros cadastrados</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fa-solid fa-money-bill fa-2x text-success mb-2"></i>
                <h3>{{ \App\Models\Car::where('payment_status', 'pago')->count() }}</h3>
                <p class="text-muted mb-0">Pagamentos em dia</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fa-solid fa-calendar-days fa-2x text-info mb-2"></i>
                <h3>{{ \App\Models\Event::count() }}</h3>
                <p class="text-muted mb-0">Eventos cadastrados</p>
            </div>
        </div>
    </div>
</div>
@endsection
