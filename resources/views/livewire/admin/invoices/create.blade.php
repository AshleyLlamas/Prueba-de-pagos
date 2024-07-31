<div class="card">
    <div class="card-body">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="submit">
            <div class="row">
                <div class="form-group col-12 col-md-8">
                    <label for="motivo">Motivo</label>
                    <input type="text" id="motivo" wire:model="motivo" class="form-control" />
                    @error('motivo') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group col-12 col-md-4">
                    <label for="monto">Monto</label>
                    <input type="number" id="monto" wire:model="monto" class="form-control" step="0.01" />
                    @error('monto') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Generar</button>
            </div>
        </form>
    </div>
</div>
