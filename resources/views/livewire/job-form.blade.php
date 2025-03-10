<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Post Jobs') }}</div>

                <div class="card-body">
                    <form wire:submit="save">
                        <div class="mb-3">
                            <input type="text" wire:model="title" placeholder="Job Title" class="form-control" />
                            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="description" class="form-label">Job Description</label>
                            <input id="trix-editor" type="hidden" wire:model="description">
                            <trix-editor input="trix-editor"></trix-editor>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" wire:model="company" placeholder="Company" class="form-control" />
                            @error('company') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" wire:model="location" placeholder="Location" class="form-control" />
                            @error('location') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" wire:model="department" placeholder="Department" class="form-control" />
                            @error('department') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="employment_type" class="col-form-label">Employment type</label>
                            <div>
                                <select name="employment_type" wire:model.defer="employment_type" class="form-select p-2 border rounded">
                                    <option value="">Select Type</option>
                                    <option value="permanent">Permanent</option>
                                    <option value="contract">Contract</option>
                                </select>
                            </div>
                            @error('employment_type') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="schedule" class="col-form-label">Schedule</label>
                            <div>
                                <select name="schedule" wire:model.defer="schedule" class="form-select p-2 border rounded">
                                    <option value="">Select schedule</option>
                                    <option value="part-time">Part time</option>
                                    <option value="full-time">Full time</option>
                                </select>
                            </div>
                            @error('schedule') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
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
<script>
    document.addEventListener("trix-change", function(event) {
        let hiddenInput = document.getElementById("trix-editor");
        hiddenInput.value = event.target.innerHTML;
        @this.set('description', hiddenInput.value);
    });
    document.addEventListener("livewire:load", function() {
        Livewire.on('reset-trix', function() {
            document.querySelector("trix-editor").value = "";
            document.getElementById("trix-editor").value = "";
        });
    });
</script>