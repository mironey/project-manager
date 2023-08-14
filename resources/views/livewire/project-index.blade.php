<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('All Project') }}</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Assigned To</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <td>{{$project->name}}</td>
                                    <td>{{$project->description}}</td>
                                    <td>{{$project->start_date}}</td>
                                    <td>{{$project->end_date}}</td>
                                    <td>{{activityStatus($project->status)}}</td>
                                    <td><a href="">{{$project->user->name}}</a></td>
                                    <th><a href="{{route('project.show', $project->id)}}">View</a> | <a href="">Edit</a> | <a href="">Delete</a></th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
