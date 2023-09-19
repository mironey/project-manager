<div>
    <div class="card mt-3">
        <div class="card-header">
            <h4>Delivery files of the project</h4>
        </div>
        <div class="card-body">
            <div class="assignment-part bg-body-secondary my-2">
                <div class="card-header fw-bold">
                Instruction
                </div>
                <div class="card-body">
                    @if( !empty($project->related_comment) || !empty($project->delivered_files) )
                        <p class="card-text">{{$project->related_comment}}</p>
                        @php 
                            $filesArray = unserialize($project->delivered_files); 
                        @endphp
                        @foreach($filesArray as $file)
                            <p><span class="fw-semibold">File:</span> <a href="{{asset($file)}}">{{$file}}</a></p>
                        @endforeach
                    @else
                    Project not started yet.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
