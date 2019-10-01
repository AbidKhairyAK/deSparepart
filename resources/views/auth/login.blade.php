<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Login</title>

  @include('assets.main-css')

</head>

<body class="bg-gray-300">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Form Login</h1>
                  </div>

                  @if(session()->has('err'))
                  <p class="p-3 bg-danger text-white rounded">{!! session('err') !!}</p>
                  @endif

                  <form class="user" action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>

                  <hr>

                 <h6>daftar user:</h6>
                 <ul>
                   <li>test@admin.com</li>
                   <li>test@karyawan.com</li>
                   <li>test@kasir.com</li>
                   <li>test@gudang.com</li>
                 </ul>

                 <h6>password:</h6>
                 <ul>
                   <li>manisbetul</li>
                 </ul>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  @include('assets.main-js')

</body>

</html>
