<?php

namespace App\Livewire\Admin\Invoices;

use App\Models\Invoice;
use Livewire\Component;

class Index extends Component
{
    public $invoices;
    public $selectedInvoices = [];
    public $selectAll = false;

    public function mount()
    {
        $this->invoices = Invoice::all();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedInvoices = $this->invoices->pluck('id')->toArray();
        } else {
            $this->selectedInvoices = [];
        }
    }

    public function deleteSelected()
    {
        if (empty($this->selectedInvoices)) {
            session()->flash('message', 'No hay facturas seleccionadas para eliminar.');
            return;
        }

        Invoice::whereIn('id', $this->selectedInvoices)->delete();

        $this->selectedInvoices = [];
        session()->flash('message', 'Facturas seleccionadas eliminadas con éxito.');
        $this->invoices = Invoice::all();
    }

    public function render()
    {
        return view('livewire.admin.invoices.index');
    }
}
