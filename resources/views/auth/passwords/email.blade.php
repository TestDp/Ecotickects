@extends('layouts.app')

@section('content')
        <div class="container">
          <div class="row justify-content-md-center">
            <div class="col-md-9 col-lg-7 col-xl-5">
                <h4>¿Olvidaste tu contraseña?</h4>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-wrap{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="form-label">Ingresa tu dirección de correo electrónico</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-input" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
