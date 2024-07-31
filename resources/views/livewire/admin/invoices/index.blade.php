<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-12 col-md-6">
                <button type="button" class="btn btn-danger btn-block my-2" wire:click="deleteSelected">Eliminar seleccionados</button>
            </div>
            <div class="col-12 col-md-6">
                <a class="btn btn-success btn-block my-2" href="{{ route('admin.invoices.create') }}">Generar</a>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if ($invoices->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        {{--  <th><input type="checkbox" wire:model="selectAll" /></th>  --}}
                        <th></th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Nombre del Usuario</th>
                        <th>Estado</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td><input type="checkbox" value="{{ $invoice->id }}" wire:model="selectedInvoices" /></td>
                            <td>{{ $invoice->motivo }}</td>
                            <td>{{ \Carbon\Carbon::parse($invoice->fecha)->format('d/m/Y H:i:s') }}</td>
                            <td>${{ number_format($invoice->monto, 2) }}</td>
                            <td>{{ $invoice->user->name }}</td>
                            <td>{{ $invoice->estatus }}</td>
                            <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.invoices.show', $invoice)}}"><i class="fas fa-eye"></i></a></td>
                            <td width="10px"><a class="btn btn-default btn-sm" href="{{route('admin.invoices.edit', $invoice)}}"><i class="fas fa-edit"></i></a></td>
                            <td width="10px">
                                <form action="{{ route('admin.invoices.destroy', $invoice) }}" method="POST" class="alert-delete">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="delete()"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-danger pt-2">Sin facturas</p>
        @endif
    </div>
</div>

@push('js')
    @if (session()->has('message'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire(
                    '¡Hecho!',
                    '{{ session('message') }}',
                    'success'
                );
            });
        </script>
    @endif
@endpush

