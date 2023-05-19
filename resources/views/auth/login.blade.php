@include('header.head')
            
     <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-6 p-4 border ">
            <form action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <h3>Login Here</h3><hr>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email">
                    @error('email')
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <p class="pt-2">Don't have an account? Register <a href="/register">here</a></p>
            </div>
        </div>
     </div>











    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    </body>
</html>
