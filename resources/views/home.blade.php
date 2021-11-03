@extends('layouts.profile')

@section('content')
						<h2 class="title">Hola {{ Auth::user()->name }}, estas son tus estadísticas.</h2>
                        <div class="row">							
                          <div class="col-md-4">
                            <div class="card card-chart">
                              <div class="card-header card-header-rose" data-header-animation="true">
                                <div class="ct-chart" id="websiteViewsChart"></div>
                              </div>
                              <div class="card-body">
                                <div class="card-actions">
                                  <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                    <i class="material-icons">build</i> Fix Header!
                                  </button>
                                  <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                                    <i class="material-icons">refresh</i>
                                  </button>
                                  <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                                    <i class="material-icons">edit</i>
                                  </button>
                                </div>
                                <h4 class="card-title">Usuarios registrados</h4>
                                <p class="card-category">Ecotickets vendidos hasta el momento</p>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <i class="material-icons">access_time</i> Información actualizada
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="card card-chart">
                              <div class="card-header card-header-success" data-header-animation="true">
                                <div class="ct-chart" id="dailySalesChart"></div>
                              </div>
                              <div class="card-body">
                                <div class="card-actions">
                                  <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                    <i class="material-icons">build</i> Fix Header!
                                  </button>
                                  <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                                    <i class="material-icons">refresh</i>
                                  </button>
                                  <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                                    <i class="material-icons">edit</i>
                                  </button>
                                </div>
                                <h4 class="card-title">Ecotickets de tu último evento</h4>
                                <p class="card-category">
                                  <span class="text-success">Redimiento de tu evento más reciente.</p>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <i class="material-icons">access_time</i> Información actualizada
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="card card-chart">
                              <div class="card-header card-header-info" data-header-animation="true">
                                <div class="ct-chart" id="completedTasksChart"></div>
                              </div>
                              <div class="card-body">
                                <div class="card-actions">
                                  <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                    <i class="material-icons">build</i> Fix Header!
                                  </button>
                                  <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                                    <i class="material-icons">refresh</i>
                                  </button>
                                  <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                                    <i class="material-icons">edit</i>
                                  </button>
                                </div>
                                <h4 class="card-title">Usuarios registrados vs Usuarios asistentes</h4>
                                <p class="card-category">Quienes fueron y quienes no.</p>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <i class="material-icons">access_time</i> Información actualizada
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
						<h2 class="title">Esto es lo juntos que hemos logrado hasta el momento</h2>
						<div class="row">
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">event_note</i>
                                </div>
                                <p class="card-category">Eventos</p>
                                <h3 class="card-title">184</h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <i class="material-icons text-danger">more_horiz</i>
                                  <a href="#">Y contando...</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">confirmation_number</i>
                                </div>
                                <p class="card-category">Ecotickets generados</p>
                                <h3 class="card-title">75.521</h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <i class="material-icons">more_horiz</i> Y contando...
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">receipt</i>
                                </div>
                                <p class="card-category">Papel ahorrado</p>
                                <h3 class="card-title">34.245 Kilos</h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <i class="material-icons">more_horiz</i> Y contando
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                              <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                  <i class="material-icons">park</i>
                                </div>
                                <p class="card-category">Árboles salvados</p>
                                <h3 class="card-title">+245</h3>
                              </div>
                              <div class="card-footer">
                                <div class="stats">
                                  <i class="material-icons">more_horiz</i> Y vamos por más
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                Desarrollado con <i class="fa fa-heart"></i> y
                <a href="https://instagram.com/ecotickets" class="font-weight-bold" target="_blank">Sosteniblidad</a>
                por un mundo mejor.
              </div>
            </div>
          </div>
        </div>
      </footer>


    <script src="{{ asset('js/Plugins/Jquery/jquery-3.1.1.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endsection
