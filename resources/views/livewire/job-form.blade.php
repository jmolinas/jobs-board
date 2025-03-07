<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Post Jobs') }}</div>

                <div class="card-body">
                    <form wire:submit="save">
                        <div class="row mb-3">
                            <input type="text" wire:model="title" placeholder="Job Title" class="form-control" />
                            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="row mb-3">
                            <textarea wire:model="description" placeholder="Job Description" class="form-control"></textarea>
                        </div>
                        @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                        <div class="row mb-3">
                            <button type="submit" class="btn btn-primary">Post Job</button>
                        </div>

                        @if(session('message'))
                        <p class="text-green-500">{{ session('message') }}</p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>