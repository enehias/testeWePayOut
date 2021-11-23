@extends('auth.template.index')
@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>Cota</b> Rural</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Entre para começar</p>
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{$error}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="documento" placeholder="CPF/CNPJ">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
{{--                            <div class="icheck-primary">--}}
{{--                                <input type="checkbox" id="remember">--}}
{{--                                <label for="remember">--}}
{{--                                    Remember Me--}}
{{--                                </label>--}}
{{--                            </div>--}}
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="Entrar" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

{{--                <div class="social-auth-links text-center mt-2 mb-3">--}}
{{--                    <a href="#" class="btn btn-block btn-primary">--}}
{{--                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook--}}
{{--                    </a>--}}
{{--                    <a href="#" class="btn btn-block btn-danger">--}}
{{--                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <!-- /.social-auth-links -->--}}

{{--                <p class="mb-1">--}}
{{--                    <a href="forgot-password.html">I forgot my password</a>--}}
{{--                </p>--}}
{{--                <p class="mb-0">--}}
{{--                    <a href="register.html" class="text-center">Register a new membership</a>--}}
{{--                </p>--}}
{{--            </div>--}}
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
