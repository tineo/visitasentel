@extends('layouts.app')

@section('content')
    <div  id="main" class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Visita</div>

                    <div class="panel-body">

                        @if( isset($visita) )
                            {{--
                            <h4>{{ $visita->getVisitantes()->get(0)->getNombre() }}</h4>
                            <h4>{{ $visita->getVisitantes()->get(0)->getDni() }}</h4>
                            <h4>{{ $visita->getVisitantes()->get(0)->getEmpresa() }}</h4>
                            <h4>{{ $visita->getVisitantes()->get(0)->getMotivo() }}</h4>
                            --}}
                            <div class="row">
                                <div class="col-md-4 col-xs-12 col-sm-4">
                                    <h3>Registro de visita</h3>
                                </div>
                                <div class="col-md-4 col-xs-12 col-sm-4">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success">
                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                            <span> Confirmar visita</span>
                                        </button>
                                        {{--<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                        </ul>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12 col-sm-4"><b>Nombre de visita:</b></div>
                                        <div class="col-md-6 col-xs-12 col-sm-8">{{ $visita->getVisitantes()->get(0)->getNombre() }}</div>
                                        <div class="col-md-4 col-xs-12 col-sm-4"><b>DNI de visita:</b></div>
                                        <div class="col-md-6 col-xs-12 col-sm-8">{{ $visita->getVisitantes()->get(0)->getDni() }}</div>
                                        <div class="col-md-4 col-xs-12 col-sm-4"><b>Empresa de visita:</b></div>
                                        <div class="col-md-6 col-xs-12 col-sm-8">{{ $visita->getVisitantes()->get(0)->getEmpresa() }}</div>
                                        <div class="col-md-4 col-xs-12 col-sm-4"><b>Motivo:</b></div>
                                        <div class="col-md-6 col-xs-12 col-sm-8">{{ $visita->getVisitantes()->get(0)->getMotivo() }}</div>
                                        <div class="col-md-4 col-xs-12 col-sm-4"><b>Contacto de entel:</b></div>
                                        <div class="col-md-6 col-xs-12 col-sm-8">{{ $visita->getContacto() }}</div>
                                        <div class="col-md-4 col-xs-12 col-sm-4"><b>Piso / Area que visita:</b></div>
                                        <div class="col-md-6 col-xs-12 col-sm-8">{{ $visita->getPiso() }} / {{ $visita->getArea() }}</div>
                                        <div class="col-md-4 col-xs-12 col-sm-4"><b>Desde / Hasta:</b></div>
                                        <div class="col-md-6 col-xs-12 col-sm-8">{{ $visita->getHoraini()->format('H:i') }} / {{ $visita->getHorafin()->format('H:i') }}</div>
                                        <div class="col-md-4 col-xs-12 col-sm-4"><b>Fecha:</b></div>
                                        <div class="col-md-6 col-xs-12 col-sm-8">{{ $visita->getFecha()->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            </div>

                            {{--<ul>
                                @foreach ($visita->getVisitantes() as $asistente)
                                    <li>{{ $asistente->getNombre() }}</li>
                                    <li>{{ $asistente->getTipo() }}</li>
                                @endforeach
                            </ul>--}}
                        @endif
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <h3>Acompañantes</h3>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                        <span> Agregar Acompañante </span>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>

                                    <th>Nombre</th>
                                    <th>DNI</th>
                                    <th>Empresa</th>
                                    <th>Correo</th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($visita->getVisitantes() as $asistente)
                                    <a href="#">
                                        <tr class='visita-row' data-href='{{ action("VisitasController@show",[   'id' => $visita->getIdvisita() ] )}}'>
                                            <td> {{ $asistente->getNombre()  }} </td>
                                            <td> {{ $asistente->getDNI() }} </td>
                                            <td> {{ $asistente->getEmpresa() }} </td>
                                            <td> {{ $asistente->getEmail() }} </td>
                                            <td> <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </td>
                                        </tr>
                                    </a>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')


@endsection