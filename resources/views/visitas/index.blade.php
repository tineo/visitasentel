@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Titulo</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>DNI</th>
                                    <th>Contacto</th>
                                    <th>Piso</th>
                                    <th>Fecha y Hora</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($visitas as $visita)
                                    <tr>
                                        <td> {{ $visita->getVisitante()->getNombre() }} </td>
                                        <td> {{ $visita->getVisitante()->getDNI() }} </td>
                                        <td> {{ $visita->getContacto() }} </td>
                                        <td> {{ $visita->getPiso() }} </td>
                                        <td> {{ $visita->getFecha()->format('d/m/Y') }} - {{ $visita->getHoraini()->format('H:i') }}  / {{ $visita->getHorafin()->format('H:i') }} </td>

                                    </tr>
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