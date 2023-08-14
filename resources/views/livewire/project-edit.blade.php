<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="">
                <div class="card">
                    <div class="card-header">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value="{{$project->name}}" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{$project->description}}</textarea>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="m-2 flex-fill">
                                <label for="exampleInputEmail1" class="form-label">Start Date</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" value="{{$project->start_date}}" aria-describedby="emailHelp">
                            </div>
                            <div class="m-2 flex-fill">
                                <label for="exampleInputEmail1" class="form-label">End Date</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" value="{{$project->end_date}}" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="m-2 flex-fill">
                                <label for="exampleInputEmail1" class="form-label">Status</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="m-2 flex-fill">
                                <label for="exampleInputEmail1" class="form-label">Assigned To</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
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
