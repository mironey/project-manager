<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form wire:submit.prevent="submitProject" autocomplete="off">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="comment" class="form-label">Instruction</label>
                                <textarea class="form-control" id="comment" wire:model="comment" rows="3"></textarea>
                                @error('comment') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">File</label>
                                <input wire:model="attachedFiles" class="form-control" type="file" id="formFileMultiple" multiple>
                                @error('attachedFiles') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit project</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
