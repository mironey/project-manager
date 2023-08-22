<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <h3>Welcome to {{Auth::user()->name}}</h3>
                <div class="card">
                    <div class="card-header">
                        <div>{{ __('All Assignments') }}</div>
                    </div>
                    <div class="card-body">
                        @foreach($assignments as $assignment)
                        <table class="table table-success table-striped">
                            <thead class="table-light">
                                <tr><th colspan="5" class="text-center">Task Name: {{$assignment->task->name}}</th></tr>
                                <tr class="table-active">
                                    <th>#</th>
                                    <th>Assignment Name</th>
                                    <th>Description</th>
                                    <th>Due Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>{{$assignment->name}}</td>
                                    <td>{{$assignment->description}}</td>
                                    <td>{{$assignment->due_date}}</td>
                                    <th>
                                    <a href="{{route('member.assignment.show', ['projectId' => $assignment->task->project_id , 'taskId' => $assignment->task_id, 'assignmentId' => $assignment->id])}}" 
                                        class="mx-2">View</a>  
                                    </th>
                                </tr>
                            </tbody>
                        </table>  
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


