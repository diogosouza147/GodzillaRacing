<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('plate', 'like', "%{$search}%")
                  ->orWhere('owner_name', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('payment_status')) {
            $query->where('payment_status', $status);
        }

        $cars = $query->orderBy('owner_name')->paginate(15)->withQueryString();

        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        Car::create($data);

        return redirect()->route('cars.index')->with('success', 'Carro cadastrado com sucesso!');
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $data = $this->validateData($request, $car->id);

        $car->update($data);

        return redirect()->route('cars.index')->with('success', 'Carro atualizado com sucesso!');
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Carro removido com sucesso!');
    }

    /**
     * Alterna rapidamente o status de pagamento (pago/pendente) do cadastro do carro.
     */
    public function togglePayment(Car $car)
    {
        $car->update([
            'payment_status' => $car->payment_status === 'pago' ? 'pendente' : 'pago',
        ]);

        return back()->with('success', 'Status de pagamento atualizado!');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'plate' => 'required|string|max:20|unique:cars,plate' . ($ignoreId ? ",{$ignoreId}" : ''),
            'model' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:100',
            'owner_name' => 'required|string|max:255',
            'owner_phone' => 'nullable|string|max:30',
            'discord_id' => 'nullable|string|max:100',
            'payment_status' => 'required|in:pago,pendente',
            'payment_value' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);
    }
}
