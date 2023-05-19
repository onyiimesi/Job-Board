@include('header.head')

        <div class="section pt-5 pb-5">
            <div class="container">
                <div class="row">
                @if(count($jobs) > 0)
                    @foreach($jobs as $job)


                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $job->title }}</h4>
                            </div>

                            <div class="card-body">
                                <p>
                                    {{ $job->description }}
                                </p>
                            </div>

                            <div class="card-footer">
                                @if (!Auth::check())
                                    <a href="{{ route('login') }}"><button type="submit" class="btn btn-success">Apply</button></a>
                                    @else
                                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#applyJobs{{ $job->id }}">Apply</a>

                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="applyJobs{{ $job->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Apply for Job</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/applyjob/{{$job->id}}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Title</label>
                                        <input type="text" readonly class="form-control" name="job_title" value="{{ $job->title }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Description</label>
                                        <textarea readonly name="job_description" class="form-control" id="" cols="30" rows="10">{{ $job->description }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-success">Apply</button>
                                </form>
                            </div>

                            </div>
                        </div>
                        </div>

                    @endforeach

                    @else
                        <h3>No Active Job</h3>

                    @endif
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
