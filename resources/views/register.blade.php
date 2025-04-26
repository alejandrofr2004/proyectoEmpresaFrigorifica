<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register Frío Market</title>
    <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-skyblue">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <img src="{{ asset('img/logo.png') }}" alt="Logo de la empresa" class="logo">
                                    <h3 class="text-center font-weight-light my-4">Register</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <!-- Nombre -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputFirstName" type="text" name="first_name"
                                                           value="{{ old('first_name') }}" placeholder="Enter your first name" required />
                                                    <label for="inputFirstName">First name</label>
                                                    @error('first_name')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Apellido -->
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="inputLastName" type="text" name="last_name"
                                                           value="{{ old('last_name') }}" placeholder="Enter your last name" required />
                                                    <label for="inputLastName">Last name</label>
                                                    @error('last_name')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputEmail" type="email" name="email"
                                                           value="{{ old('email') }}" placeholder="name@example.com" required />
                                                    <label for="inputEmail">Email address</label>
                                                    @error('email')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Teléfono -->
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputPhone" type="tel" name="phone"
                                                           value="{{ old('phone') }}" placeholder="Enter your phone number" required />
                                                    <label for="inputPhone">Phone number</label>
                                                    @error('phone')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Contraseña -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPassword" type="password" name="password"
                                                           value="{{ old('password') }}" placeholder="Create a password" required />
                                                    <label for="inputPassword">Password</label>
                                                    @error('password')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Confirmar contraseña -->
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPasswordConfirm" type="password" name="password_confirmation"
                                                           value="{{ old('password_confirmation') }}" placeholder="Confirm password" required />
                                                    <label for="inputPasswordConfirm">Confirm Password</label>
                                                    @error('password_confirmation')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center w-100">
                                            <button type="submit" class="btn btn-primary">Register</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="{{ route('login') }}">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('template/js/scripts.js') }}"></script>
</body>

</html>
