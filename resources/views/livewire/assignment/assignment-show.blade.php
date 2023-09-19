<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <div class="card">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center">
                        <div>
                            <h3>Assignment name:</h3>
                            <p>{{$assignment->name}}</p>
                        </div>
                        <div>
                            <span class="badge bg-primary">{{activityStatus($assignment->status)}}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Due Date</th>
                                    <th>Assigned To</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$assignment->due_date}}</td>
                                    <td><a href="">{{$assignment->user->name}}</a></td>
                                    <th>
                                    @hasanyrole('super-admin|admin')
                                        <a href="{{route('admin.assignment.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a> | <a href="">Delete</a>
                                    @endhasanyrole
                                    @hasrole('manager')
                                        <a href="{{route('manager.assignment.edit', ['projectId' => $task->project_id, 'taskId' => $task->id])}}" class="mx-2">Edit</a> | <a href="">Delete</a>
                                    @endhasrole    
                                    @hasrole('supervisor')
            
                                        @if($enableStatusForm)
                                            <select wire:model="selectStatus" wire:change="updateStatus" class="border-0">
                                                @foreach($statusOption as $option)
                                                <option value="{{$loop->iteration}}">{{$option}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <span class="text-primary fw-bold" wire:click="changeStatusForm">Change Status</span>
                                        @endif
                                        |
                                        <a href="{{route('supervisor.assignment.edit', ['projectId' => $projectId, 'taskId' => $assignment->task_id, 'assignmentId' => $assignment->id])}}" class="mx-2">Edit</a>
                                        | 
                                        <a href="">Delete</a>
                                    @endhasrole   
                                    @hasrole('member')
                                        @if($assignment->status == 1)
                                            <form wire:submit.prevent="startAssignment">
                                                @csrf
                                                <button onclick="return confirm('Are you sure to start now ?')" class="p-0 m-0 border-0 text-primary fw-bold">Start Now</button>
                                            </form>
                                        @elseif($assignment->status == 2)
                                            <a href="{{route('member.assignment.submit', ['projectId' => $projectId, 'taskId' => $assignment->task_id, 'assignmentId' => $assignment->id])}}" class="mx-2">Deliver now</a>
                                        @elseif($assignment->status == 3)
                                            <a href="{{route('member.assignment.submit', ['projectId' => $projectId, 'taskId' => $assignment->task_id, 'assignmentId' => $assignment->id])}}" class="mx-2">Deliver again</a>
                                        @else 
                                            Assignment completed
                                        @endif
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
                                @if( !empty($assignment->helping_kits) )
                                    @php 
                                        $filesArray = unserialize($assignment->helping_kits); 
                                    @endphp
                                    @foreach($filesArray as $file)
                                        <a class="btn btn-primary m-2" href="{{asset($file)}}">{{$file}}</a>
                                    @endforeach
                                @else
                                    <span class="btn btn-primary">No file shared</span>
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Delivered files</h4>
                    </div>
                    <div class="card-body">
                        <div class="assignment-part bg-body-secondary my-2">
                            <div class="card-header fw-bold">
                            Instruction
                            </div>
                            <div class="card-body">
                                @if( !empty($assignment->member_comment) || !empty($assignment->delivered_files) )
                                    <p class="card-text">{{$assignment->member_comment}}</p>
                                    @php 
                                        $filesArray = unserialize($assignment->delivered_files); 
                                    @endphp
                                    @foreach($filesArray as $file)
                                        <p><span class="fw-semibold">File:</span> <a href="{{asset($file)}}">{{$file}}</a></p>
                                    @endforeach
                                @else
                                Assignment not started yet.
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
