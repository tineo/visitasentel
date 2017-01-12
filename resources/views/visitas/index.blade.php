@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Titulo</div>
                    <div class="panel-heading panel-pagination">

                        <div class="row">
                            <div class="col-md-4">
                                <form action="/visitas">
                                     <div class="input-group">
                                         <span class="input-group-addon" id="basic-addon3">DNI</span>
                                         <input type="text" class="form-control"
                                               id="basic-url" aria-describedby="basic-addon3"
                                               name="dni" value="{{ Request::get('dni') }}"
                                         />
                                         {{--@if(Request::get('p') != "")
                                         <input type="hidden" name="p" value="{{ Request::get('p') }}" />
                                         @endif--}}
                                     </div>
                                </form>
                            </div>
                            <div class="col-md-8">

                                <?php
                                    list(, $action) = explode('@', Route::getCurrentRoute()->getActionName());
                                    $actionname = "VisitasController@". $action;
                                ?>


                                <nav aria-label="Page navigation">
                                    @if($pages > 1)
                                    <ul class="pagination">
                                        @if( ( Request::get('p') != ""  and Request::get('p') != 1 ))
                                        <li>
                                            <a href="{{ action($actionname,
                                                        [   'dni' => Request::get('dni'),
                                                            'p' => Request::get('p') - 1 ]) }}">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        @endif


                                        @for ($i = 1; $i <= $pages; $i++)
                                        <li>
                                            <a href="{{ action($actionname,
                                                        [   'dni' => Request::get('dni'),
                                                            'p' => $i ]) }}">{{ $i }}</a>
                                        </li>
                                        @endfor
                                            <li>
                                            @if( ( Request::get('p') != "" and $pages != Request::get('p'))  )

                                                    <a href="{{ action($actionname,
                                                        [   'dni' => Request::get('dni'),
                                                            'p' => Request::get('p') + 1 ]) }}">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>

                                            @elseif(Request::get('p') == "")

                                                    <a href="{{ action($actionname,
                                                        [   'dni' => Request::get('dni'),
                                                            'p' => 2  ]) }}">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>

                                            @endif
                                            </li>
                                    </ul>
                                    @endif
                                </nav>

                            </div>
                        </div>

                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
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
                                        <td> {{ $visita->getIdvisita() }} </td>
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