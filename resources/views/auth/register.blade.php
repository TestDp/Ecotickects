@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-9 col-lg-7 col-xl-5">
            <div class="panel panel-default">
                <div class="panel-heading">Registrate en Ecotickets</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label black black">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label black">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label black">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label black">Confirmar Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="RazonSocial" class="col-md-4 col-form-label text-md-right">{{ __('Razón Social') }}</label>

                            <div class="col-md-6">
                                <input id="RazonSocial" type="text" class="form-control{{ $errors->has('RazonSocial') ? ' is-invalid' : '' }}" name="RazonSocial" value="{{ old('RazonSocial') }}" required autofocus>

                                @if ($errors->has('RazonSocial'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('RazonSocial') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="NitEmpresa" class="col-md-4 col-form-label text-md-right">{{ __('Nit Empresa') }}</label>

                            <div class="col-md-6">
                                <input id="NitEmpresa" type="text" class="form-control{{ $errors->has('NitEmpresa') ? ' is-invalid' : '' }}" name="NitEmpresa" value="{{ old('NitEmpresa') }}" required autofocus>

                                @if ($errors->has('NitEmpresa'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('NitEmpresa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="IdentificacionRepresentante" class="col-md-4 col-form-label text-md-right">{{ __('Identificación Representante') }}</label>

                            <div class="col-md-6">
                                <input id="IdentificacionRepresentante" type="text" class="form-control{{ $errors->has('IdentificacionRepresentante') ? ' is-invalid' : '' }}" name="IdentificacionRepresentante" value="{{ old('IdentificacionRepresentante') }}" required autofocus>

                                @if ($errors->has('IdentificacionRepresentante'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('IdentificacionRepresentante') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Direccion" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

                            <div class="col-md-6">
                                <input id="Direccion" type="text" class="form-control{{ $errors->has('Direccion') ? ' is-invalid' : '' }}" name="Direccion" value="{{ old('Direccion') }}" required autofocus>

                                @if ($errors->has('Direccion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Direccion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Telefono" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                            <div class="col-md-6">
                                <input id="Telefono" type="text" class="form-control{{ $errors->has('Telefono') ? ' is-invalid' : '' }}" name="Telefono" value="{{ old('Telefono') }}" required autofocus>

                                @if ($errors->has('Telefono'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="CorreoElectronico" class="col-md-4 col-form-label text-md-right">{{ __('Correo Corporativo') }}</label>

                            <div class="col-md-6">
                                <input id="CorreoElectronico" type="text" class="form-control{{ $errors->has('CorreoElectronico') ? ' is-invalid' : '' }}" name="CorreoElectronico" value="{{ old('CorreoElectronico') }}" required autofocus>

                                @if ($errors->has('CorreoElectronico'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('CorreoElectronico') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="SitioWeb" class="col-md-4 col-form-label text-md-right">{{ __('Sitio Web') }}</label>

                            <div class="col-md-6">
                                <input id="SitioWeb" type="text" class="form-control{{ $errors->has('SitioWeb') ? ' is-invalid' : '' }}" name="SitioWeb" value="{{ old('SitioWeb') }}" required autofocus>

                                @if ($errors->has('SitioWeb'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('SitioWeb') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-blue ripple trial-button">
                                    Registrarse
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
