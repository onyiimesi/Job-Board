@include('header.head')
            
     <div class="container">
        <div class="row mt-5 mb-5 justify-content-center">
            <div class="col-md-6 p-4 border ">
            
            <form action="/register" method="POST">
                @csrf
                <div class="mb-3">
                    <h3>Register Here</h3><hr>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Role</label>
                    <select class="form-select" name="role">
                        <option value="">Choose</option>
                        <option value="employer">Employer</option>
                        <option value="candidate">Candidate</option>
                    </select>
                    @error('role')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password">
                    @error('confirm_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <p class="pt-3">Already have an account? Login <a href="/login">here</a></p>
            </div>
        </div>
     </div>











    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    </body>
</html>

