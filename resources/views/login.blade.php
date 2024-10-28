<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="text-center mt-5">Login</h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('validate_login') }}" method="POST">
          @csrf

          <!-- Email -->
          <div class="form-group">
            <label for="email">Email address</label>
            @error('email')
                <div class="text-danger">{{$message}}</div>
            @enderror
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
          </div>

          <!-- Password -->
          <div class="form-group">
            <label for="password">Password</label>
            @error('password')
                <div class="text-danger">{{$message}}</div>
            @enderror
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
