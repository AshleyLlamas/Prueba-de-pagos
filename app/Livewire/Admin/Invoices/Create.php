<?php

namespace App\Livewire\Admin\Invoices;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $motivo, $monto;

    public function rules()
    {
        return [
            'motivo' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    // Verifica si ya existe una factura con el mismo motivo y fecha
                    $exists = Invoice::where('motivo', $value)
                        ->whereDate('fecha', Carbon::today())
                        ->exists();

                    if ($exists) {
                        $fail('El motivo ya ha sido utilizado para el día de hoy.');
                    }
                }
            ],
            'monto' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function submit()
    {
        $this->validate();

        Invoice::create([
            'user_id' => Auth::id(),
            'motivo' => $this->motivo,
            'fecha' => Carbon::now(),
            'monto' => $this->monto,
        ]);

        session()->flash('message', 'Factura creada con éxito.');
        return redirect()->route('admin.invoices.index');
    }

    public function render()
    {
        return view('livewire.admin.invoices.create');
    }
}
