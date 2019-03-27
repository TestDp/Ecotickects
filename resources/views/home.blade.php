@extends('layouts.profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h3>Bievenido a Ecotickets</h3></div>
					<div style="margin:0px !important;" class="row">
					<img style="display:block; margin:auto;" src="{{ asset('img/icono.png') }}" data-active-url="{{ asset('img/icono.png') }}" alt="">
					<h3>En el menú del lado izquierdo podrás administrar todo lo relacionado con tus eventos.</h3>
					</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endsection
