<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form wire:submit.prevent="createTask" autocomplete="off">
                    <div class="card">
                        <div class="card-header">
                            <div class="mb-3">
                                <label for="name" class="form-label">Task Name</label>
                                <input type="text" class="form-control" id="name" wire:model="name">
                                @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" wire:model="description" rows="3"></textarea>
                                @error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="m-2 flex-fill">
                                    <label for="due_date" class="form-label">Due Date</label>
                                    <input type="text" class="form-control" id="due_date" wire:model="due_date">
                                    @error('due_date') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="m-2 flex-fill">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" wire:model="status">
                                        <option>Select Status</option>
                                        <option value="1">Not started</option>
                                        <option value="2">In progress</option>
                                        <option value="3">Completed</option>
                                    </select>
                                    @error('status') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="m-2 flex-fill">
                                    <label for="assigned_user" class="form-label">Assigned To</label>
                                    <select class="form-select" id="assigned_user" wire:model="assigned_user">
                                        <option>Select Person</option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}} (2)</option>
                                        @endforeach
                                    </select>
                                    @error('assigned_user') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
