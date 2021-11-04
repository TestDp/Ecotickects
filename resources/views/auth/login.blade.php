@extends('layouts.app')

@section('content')
        <div class="container">
          <div class="row justify-content-md-center">
            <div class="col-md-9 col-lg-7 col-xl-5">
                <h4>Ingresa tu usuario y tu contraseña</h4>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-wrap{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label style="color:#000;" for="email" class="form-label">Email</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-input" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-wrap{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label style="color:#000;" for="password" class="form-label">Contraseña</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-input" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar usuario
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <button type="submit" class="button button-block button-primary">
                                    Iniciar Sesión
                                </button>

                                <a class="btn btn-blue-fill ripple" href="{{ route('password.request') }}">
                                    Olvidó su contraseña?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
