<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Job Board</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="">
       <div class="header bg-dark p-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="text-white">Employer Dashboard</h4>
                    </div>

                    <div class="col-md-4">

                    </div>

                    <div class="col-md-4 text-end">
                       <!-- <a href="/admin/users"><button class="btn btn-primary">View Users</button></a> -->
                       <a href="/admin/logout"><button class="btn btn-danger">Logout</button></a>
                    </div>
                </div>
            </div>
       </div>     
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-md-8 d-flex justify-content-between">
                    <div class="">
                        <h3>Posted Jobs</h3>
                    </div>
                    <div class="">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Post Job</button>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 p-4 border table-responsive">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($jobs as $job)
                            
                            <tr>
                                
                                <th>{{ $job->id }}</th>
                                <td>{{ $job->title }}</td>
                                <td width="300px">{{ Str::words($job->description, 20,'...') }}</td>
                                <td>{{ $job->status }}</td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#viewJobs{{ $job->id }}">View</a>

                                    <a class="btn btn-info btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#editJobs{{ $job->id }}">Edit</a>

                                    <form action="{{ route('delete.job', $job->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="alert('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                                
                            </tr>

                            <div class="modal fade" id="viewJobs{{ $job->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">View Job</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/employer/postjob" method="POST">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                                <input type="text" class="form-control" readonly value="{{ $job->title }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Description</label>
                                                <textarea readonly name="description" class="form-control" id="" cols="30" rows="10">{{ $job->description }}</textarea>
                                            </div>
                                            
                                        </form>
                                    </div>
                                    
                                    </div>
                                </div>
                                </div>

                                <div class="modal fade" id="editJobs{{ $job->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Job</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('edit.jobs', $job->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" value="{{ $job->title }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Description</label>
                                                <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $job->description }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </form>
                                    </div>
                                    
                                    </div>
                                </div>
                                </div>
                                
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/employer/postjob" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            
            </div>
        </div>
        </div>







        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <script>
            @if(Session::has('success'))
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                };
                toastr.success("{{ session('success') }}");
            @endif
        </script>

    </body>
</html>
