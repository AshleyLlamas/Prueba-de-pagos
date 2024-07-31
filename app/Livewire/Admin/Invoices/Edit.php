<?php

namespace App\Livewire\Admin\Invoices;

use App\Models\Invoice;
use Livewire\Component;

class Edit extends Component
{
    public $invoice, $motivo, $monto, $estatus;
    public function mount($invoice)
    {
        $this->invoice = $invoice;
        $this->motivo = $invoice->motivo;
        $this->monto = $invoice->monto;
        $this->estatus = $invoice->estatus;
    }

    public function rules()
    {
        return [
            'motivo' => ['required', 'string', 'max:255', 'unique:invoices,motivo,' . $this->invoice->id],
            'monto' => ['required', 'numeric', 'min:0'],
            'estatus' => ['required', 'in:Pendiente,Liquidado'],
        ];
    }

    public function submit()
    {
        $this->validate();

        $estatus = $this->estatus;
        if($this->monto == 0){
            $estatus = 'Liquidado';
        }

        $this->invoice->update([
            'motivo' => $this->motivo,
            'monto' => $this->monto,
            'estatus' => $estatus,
        ]);

        session()->flash('message', 'Factura actualizada con éxito.');
        return redirect()->route('admin.invoices.index');
    }

    public function render()
    {
        return view('livewire.admin.invoices.edit');
    }
}
