<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    Customer Relationship Management
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silakan login untuk masuk</p>

      @include('partials.alert')
      
      <form action="{{ route('proses_login') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">Remember Me</label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Scripts -->
    @include('partials.scripts')
</body>
</html>
