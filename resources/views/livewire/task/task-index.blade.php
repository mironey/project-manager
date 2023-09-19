<div>
    <div class="card mt-3">
        <div class="card-header d-flex flex-row justify-content-between align-items-center">
            <div>
                <h4>{{ __('Task List') }}</h4>
                <p>This package allows for users to be associated with permissions and roles.</p>
            </div>
            <div>
                @hasanyrole('super-admin|admin')
                <a class="btn btn-primary" href="{{route('admin.task.create', $projectId)}}">{{ __('Add Task') }}</a>
                @endhasanyrole
                @hasrole('manager')
                <a class="btn btn-primary" href="{{route('manager.task.create', $projectId)}}">{{ __('Add Task') }}</a>
                @endhasrole
            </div>
        </div>
        <div class="card-body">
            <ol class="list-group list-group-numbered">
                @foreach($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">{{$task->name}}</div>
                        {{$task->description}}
                        <div class="d-flex flex-row justify-content-between">
                            <p><strong>Due date:</strong> {{$task->due_date}}</p>
                            <p><strong>Priority:</strong> {{$task->priority}}</p>
                            <p><strong>Assigned to:</strong> {{$task->user->name}}</p>
                        </div>
                        <div class="d-inline-flex">
                        @hasanyrole('super-admin|admin')
                            <a href="{{route('admin.task.show', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" 
                            class="mx-2">View</a>
                            <a href="{{route('admin.task.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a>
                            <a href="" class="mx-2">Delete</a>
                        @endhasanyrole
                        @hasrole('manager')
                            <a href="{{route('manager.task.show', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" 
                            class="mx-2">View</a>
                            <a href="{{route('manager.task.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a>
                            <a href="" class="mx-2">Delete</a>
                        @endhasrole
                            
                        </div>
                    </div>
                    <span class="badge bg-primary rounded-pill">In Progress</span>
                </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
