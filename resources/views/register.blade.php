<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="text-center mt-5">Register</h2>

        <form action="{{ route('validate_register') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="name">Name</label>
            @error('name')
                <div class="text-danger">{{$message}}</div>
            @enderror
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your name">
          </div>

          <div class="form-group">
            <label for="email">Email address</label>
            @error('email')
                <div class="text-danger">{{$message}}</div>
            @enderror
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            @error('password')
                <div class="text-danger">{{$message}}</div>
            @enderror
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
