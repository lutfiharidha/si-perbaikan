<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>DAYAH</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body class="bg-primary">
    <div id="layoutAuthentication">
      <div id="layoutAuthentication_content">
        <main>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                  <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Login</h3>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                      <div class="form-group">
                        <label class="small mb-1" for="inputEmailAddress"
                          >Email</label
                        ><input
                          class="form-control py-4 @error('email') is-invalid @enderror"
                          id="inputEmailAddress"
                          type="email"
                          placeholder="Enter email address"
                          name="email"
                          value="{{ old('email') }}" required autocomplete="email" autofocus
                        />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label class="small mb-1" for="inputPassword"
                          >Password</label
                        ><input
                          class="form-control py-4 @error('password') is-invalid @enderror"
                          id="inputPassword"
                          type="password"
                          placeholder="Enter password"
                          name="password" required autocomplete="current-password"
                        />
                      </div>
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input
                            class="custom-control-input"
                            type="checkbox"
                            name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                          /><label
                            class="custom-control-label"
                            for="rememberPasswordCheck"
                            >Remember password</label
                          >
                        </div>
                      </div>
                      <div
                        class="form-groupmt-4 mb-0"
                      >
                      <button type="submit" class="btn btn-primary float-right">
                        {{ __('Login') }}
                    </button>

                      </div>
                    </form>
                  </div>
                  <div class="card-footer text-center">
                    <div class="small">
                      <a href="register.html">Need an account? Sign up!</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
