<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('cars')->orderBy('event_date', 'desc')->paginate(10);

        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $event = Event::create($data);

        return redirect()->route('events.show', $event)->with('success', 'Evento criado com sucesso!');
    }

    public function show(Event $event)
    {
        $event->load('cars');

        // Carros que ainda não estão inscritos neste evento, para o formulário de adicionar
        $availableCars = Car::whereNotIn('id', $event->cars->pluck('id'))
            ->orderBy('owner_name')
            ->get();

        return view('events.show', compact('event', 'availableCars'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $this->validateData($request);

        $event->update($data);

        return redirect()->route('events.show', $event)->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento removido com sucesso!');
    }

    /**
     * Adiciona um carro à lista de participantes do evento.
     */
    public function addCar(Request $request, Event $event)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'payment_status' => 'required|in:pago,pendente',
            'payment_value' => 'nullable|numeric|min:0',
        ]);

        $event->cars()->syncWithoutDetaching([
            $request->car_id => [
                'payment_status' => $request->payment_status,
                'payment_value' => $request->payment_value,
            ],
        ]);

        return back()->with('success', 'Carro inscrito no evento!');
    }

    /**
     * Alterna o status de pagamento do carro para este evento específico.
     */
    public function toggleCarPayment(Event $event, Car $car)
    {
        $current = $event->cars()->where('car_id', $car->id)->first()?->pivot->payment_status;

        $event->cars()->updateExistingPivot($car->id, [
            'payment_status' => $current === 'pago' ? 'pendente' : 'pago',
        ]);

        return back()->with('success', 'Status de pagamento do evento atualizado!');
    }

    /**
     * Remove um carro da lista de participantes do evento.
     */
    public function removeCar(Event $event, Car $car)
    {
        $event->cars()->detach($car->id);

        return back()->with('success', 'Carro removido do evento!');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
        ]);
    }
}
