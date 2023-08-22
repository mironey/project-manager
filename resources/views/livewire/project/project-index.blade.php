<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <div class="card">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center">
                        <div>{{ __('All Project') }}</div>
                        <div><a class="btn btn-primary" href="{{route('project.create')}}">{{ __('Add Project') }}</a></div>
                    </div>
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
                                    <th>
                                        @include('partials.view', ['route' => 'admin.project.show','id' => $project->id])  
                                        @include('partials.edit', ['route' => 'admin.project.edit','id' => $project->id]) 
                                        @include('partials.destroy', ['id' => $project->id]) 
                                    </th>
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
