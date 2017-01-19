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
                                    <h3>Registro de visita </h3>
                                    <span style="display: none" id="visitaid">{{ $visita->getIdvisita() }}</span>
                                </div>
                                <div class="col-md-5 col-xs-12 col-sm-6">
                                    <div class="btn-group">

                                        @if($visita->getState() == 0)

                                        @if(Auth::user()->hasRoleByName(['clerk']))
                                        <button type="button" class="btn btn-success" id="btn-confirmar">
                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                            <span> Confirmar</span>
                                        </button>
                                        @endif

                                        @if(Auth::user()->hasRoleByName(['user']))
                                        <button type="button" class="btn btn-danger" id="btn-anular">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                            <span>Anular</span>
                                        </button>
                                        <button type="button" class="btn btn-danger dropdown-toggle btn-dd" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu btn-dd">
                                            <li><a href="{{ action("DashController@index",[   'postpone' => $visita->getIdvisita() ] )}}" id="btn-postergar">Postergar</a></li>
                                        </ul>
                                        @endif

                                        @else
                                            @if($visita->getState() == 1)
                                                <button type="button" class="btn btn-primary" id="noconfirmar">
                                                    <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
                                                    <span> Confirmada</span>
                                                </button>
                                            @elseif($visita->getState() == 2)
                                                <button type="button" class="btn btn-danger" id="noanular">
                                                    <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                                                    <span> Anulada</span>
                                                </button>
                                            @endif

                                        @endif

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
                                @if($visita->getState() == 0)
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default" id="addvisitante">
                                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                        <span> Agregar Acompañante </span>
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table" id="visitantes-table">
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
                                    @if($asistente->getTipo() != 1)
                                    <a href="#">
                                        <tr data-asistente="{{ $asistente->getIdasistente() }}" >
                                            <td> {{ $asistente->getNombre()  }} </td>
                                            <td> {{ $asistente->getDNI() }} </td>
                                            <td> {{ $asistente->getEmpresa() }} </td>
                                            <td> {{ $asistente->getEmail() }} </td>
                                            <td>
                                                @if($visita->getState() == 0)
                                                <span class="glyphicon glyphicon-trash delete-asistente"
                                                      aria-hidden="true"
                                                      data-asistente="{{ $asistente->getIdasistente() }}"
                                                      title="Eliminar acompañante"
                                                ></span>
                                                @endif
                                            </td>
                                        </tr>
                                    </a>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="dialog_new" title="Agregar Acompañante" >
        <p class="validateTips"></p>
        <h6>Registro de visitas</h6>
        <form id="visitaform">
            <fieldset>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="" class="text ui-widget-content ui-corner-all" required>
                <label for="dni">DNI</label>
                <input type="text" name="dni" id="dni" value="" class="text ui-widget-content ui-corner-all">
                <label for="empresa">Empresa</label>
                <input type="text" name="empresa" id="empresa" value="" class="text ui-widget-content ui-corner-all">
                <label for="motivo">Motivo</label>
                <input type="text" name="motivo" id="motivo" value="" class="text ui-widget-content ui-corner-all">
                <label for="contacto">Correo</label>
                <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">

                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
    </div>
@endsection

@section('js')
<script type="text/javascript">
    $(function() {

        var validator = $("#visitaform").validate({
            rules: {
                dni: {
                    required: true,
                    digits: true,
                    minlength: 8,
                    maxlength: 8
                },
                email: {
                    required: true,
                    email: true
                }
            },
            submitHandler: function(form) {
                $('#visitaform input[type="submit"]').attr("disable", "disable");
            }
        });

        $( "#dialog_new" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 500,
            modal: true,
            show: {
                effect: "blind",
                duration: 1000
            },
            close: function(e){
                validator.resetForm();
                //$(".dia-selected").removeClass('dia-selected');
                $( this ).dialog( "close" );
            },
            buttons: {
                "Agregar": function(event) {

                    $(event.target).prop('disabled', true);
                    if($("#visitaform").valid()){

                        $.ajax({ method: "POST", url: "/api/visitas/addvisitante",
                            data: {
                                empresa: $("#empresa").val(),
                                motivo: $("#motivo").val(),
                                dni: $("#dni").val(),
                                email: $("#email").val(),
                                visitaid: $("#visitaid").text(),
                                nombre: $("#nombre").val()
                            }
                        }).done(function (msg) {
                            validator.resetForm();
                            $( this ).dialog( "close" );
                            $(event.target).prop('disabled', false);

                            var del0 = $("<td></td>");
                            var del = $('<span class="glyphicon glyphicon-trash delete-asistente" aria-hidden="true" data-asistente="'+msg.code+'" title="Eliminar acompañante"></span>');
                            makeclickable(del);

                            del.appendTo(del0);


                            $('<tr data-asistente="'+msg.code+'"></tr>')
                                .append("<td>"+ $("#nombre").val() +"</td>")
                                .append("<td>"+ $("#dni").val() +"</td>")
                                .append("<td>"+ $("#empresa").val() +"</td>")
                                .append("<td>"+ $("#email").val() +"</td>")
                                .append(del0).appendTo("#visitantes-table tbody");



                        }.bind(this));
                    }
                },
                "Cancelar": function() {
                    validator.resetForm();
                    //$(".dia-selected").removeClass('dia-selected');
                    $( this ).dialog( "close" );
                }
            }
        });

        $("#addvisitante").click(function () {
            $("#dialog_new").dialog('open');
        });
        var hasClicked = false;


        $("#btn-confirmar").on('click',function (event) {
            if (hasClicked === true) {
                //submit form here
            } else {
                event.preventDefault();
                hasClicked = true;
                $.ajax({
                    method: "POST", url: "/api/visitas/changestate",
                    data: {
                        visitaid: $("#visitaid").text(),
                        state: 1
                    }
                }).done(function (msg) {
                    $(this).removeClass("btn-success").addClass("btn-primary");
                    var span = $(this).find("span");
                    span.eq(0).removeClass("glyphicon-ok").addClass("glyphicon-ok-circle");
                    span.eq(1).text("Confirmada");

                    if ($("#btn-anular").length) {
                        $("#btn-anular").remove();
                        $("#addvisitante").remove();
                        $(".btn-dd").remove();
                    }
                    $(this).attr("disable", "disable");
                    $(this).attr("id", "noconfirmar");

                    $(".delete-asistente").remove();

                }.bind(this));
            }
        });

        $("#btn-anular").on('click',function (event) {
            if (hasClicked === true) {
                //submit form here
            } else {
                event.preventDefault();
                hasClicked = true;
                $.ajax({
                    method: "POST", url: "/api/visitas/changestate",
                    data: {
                        visitaid: $("#visitaid").text(),
                        state: 2
                    }
                }).done(function (msg) {
                    //$(this).removeClass("btn-success").addClass("btn-primary");
                    var span = $(this).find("span");
                    span.eq(0).removeClass("glyphicon-remove").addClass("glyphicon-remove-circle");
                    span.eq(1).text("Anulada");
                    if ($("#btn-confirmar").length) {
                        $("#btn-confirmar").remove();
                        $("#addvisitante").remove();
                        $(".btn-dd").remove();
                    }
                    $(this).attr("disable", "disable");
                    $(this).attr("id", "noanular");
                    $(this).click(false);
                }.bind(this));

                $(".delete-asistente").remove();
            }
        });

        makeclickable($(".delete-asistente"));

        function makeclickable(element) {
            element.click(function (event) {
                $.ajax({ method: "POST", url: "/api/visitas/delvisitante",
                    data: {
                        asistente: $(this).data("asistente")
                    }
                }).done(function (msg) {

                    $("tr[data-asistente="+$(this).data("asistente")+"]").remove();

                }.bind(this));

            });
        }


    });
</script>

@endsection