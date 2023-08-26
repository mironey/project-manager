<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>{{$assignment->name}}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Assigned To</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$assignment->due_date}}</td>
                                    <td>{{activityStatus($assignment->status)}}</td>
                                    <td><a href="">{{$assignment->user->name}}</a></td>
                                    <th>
                                    @hasanyrole('super-admin|admin')
                                        <a href="{{route('admin.assignment.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a> | <a href="">Delete</a>
                                    @endhasanyrole
                                    @hasrole('manager')
                                        <a href="{{route('manager.assignment.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a> | <a href="">Delete</a>
                                    @endhasrole    
                                    @hasrole('supervisor')
                                    <a href="{{route('supervisor.assignment.edit', ['projectId' => $projectId, 'taskId' => $assignment->task_id, 'assignmentId' => $assignment->id])}}" class="mx-2">Edit</a> | <a href="">Delete</a>
                                    @endhasrole   
                                    @hasrole('member')
                                    <a href="{{route('member.assignment.submit', ['projectId' => $projectId, 'taskId' => $assignment->task_id, 'assignmentId' => $assignment->id])}}" class="mx-2">Start now</a>
                                    @endhasrole    
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <div class="card-instruction">
                            <h5 class="border-bottom">Requirement:</h5>
                            <p class="text-start">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Neque quia nesciunt quas sapiente deserunt mollitia id obcaecati, a dignissimos! Exercitationem consequuntur inventore recusandae veritatis iusto consequatur numquam beatae.</p>
                            <div class="card text-center">
                                <div class="card-body">
                                    <p class="card-text">There have some attached file which you need to use to complete the assignment.</p>
                                    <a href="#" class="btn btn-primary">Download File one</a>
                                    <a href="#" class="btn btn-primary">Download File two</a>
                                    <a href="#" class="btn btn-primary">Download File three</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Your submitted file</h4>
                    </div>
                    <div class="card-body">
                        <div class="assignment-part bg-body-secondary my-2">
                            <div class="card-header fw-bold">
                            Instruction
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{$assignment->member_comment}}</p>
                                <p><span class="fw-semibold">File:</span> <a href="{{asset($assignment->complete_assignment)}}">{{$assignment->name}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
