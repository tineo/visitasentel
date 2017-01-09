@extends('layouts.app')

@section('content')



    <div class="container">
        <!--<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <button class="ui-button ui-widget ui-corner-all" id="oneless"><<</button>
                        <button class="ui-button ui-widget ui-corner-all" id="onemore">>></button>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Visitas programadas <span id="current_day"></span></div>
                    <div class="panel-heading">
                        <button class="ui-button ui-widget ui-corner-all" id="oneless"><<</button>
                        <button class="ui-button ui-widget ui-corner-all" id="onemore">>></button>

                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">

                           <table class="table">

                            <?php
                            setlocale(LC_ALL,"es_ES");
                            date_default_timezone_set('America/Lima');
                            $now = new \DateTime();

                                $days = array( "Monday" => "Lunes",
                                        "Tuesday" => "Martes",
                                        "Wednesday" => "Miercoles",
                                        "Thursday" => "Jueves",
                                        "Friday" => "Viernes",
                                        "Saturday" => "Sabado",
                                        "Sunday" => "Domingo"
                                        )
                            ?>

                            <thead>
                                <tr>
                                    <th class="horas">Horas</th>
                                    @for ($i = 0; $i < 7; $i++)
                                        <th title="{{strftime("%d/%m/%y", $now->getTimestamp()) }}">{{ $days[strftime("%A", $now->getTimestamp())] }}
                                            {{strftime("%d", $now->getTimestamp()) }}</th>
                                        <?php $now->modify('+1 day')?>
                                    @endfor

                                </tr>
                            </thead>
                            <tbody>

                            <?php $now = new \DateTime();
                            $now->setTime(8,0);
                            ?>

                            @for ($i = 0; $i < 22; $i++)
                                <tr>

                                    <td class="horas">{{ $now->format('H:i') }}</td>

                                    @for ($j = 0; $j < 7; $j++)
                                        <td
                                                data-day="{{ "d_".$now->format('d_m_Y') }}"
                                                data-hour="{{ "d_".$now->format('H_i') }}"
                                        >{{-- $now->format('d/m/Y H:i') --}}</td>
                                        <?php $now->modify('+1 day')?>
                                    @endfor
                                    <?php $now->modify('-7 day')?>
                                </tr>
                                <?php $now->add(new \DateInterval('PT30M'))?>

                            @endfor

                            </tbody>
                        </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>


    </style>

    <div id="dialog_new" title="Visitas" >
        <p class="validateTips"></p>
        <h6>Registro de visitas</h6>
        <form id="visitaform">
            <fieldset>
                <label for="nombre">Nombre de visita</label>
                <input type="text" name="nombre" id="nombre" value="" class="text ui-widget-content ui-corner-all" required>
                <label for="dni">DNI de visita</label>
                <input type="text" name="dni" id="dni" value="" class="text ui-widget-content ui-corner-all">
                <label for="empresa">Empresa de visita</label>
                <input type="text" name="empresa" id="empresa" value="" class="text ui-widget-content ui-corner-all">
                <label for="motivo">Motivo</label>
                <input type="text" name="motivo" id="motivo" value="" class="text ui-widget-content ui-corner-all">
                <label for="contacto">Contacto Entel</label>
                <input type="text" name="contacto" id="contacto" value="" class="text ui-widget-content ui-corner-all">
                <label for="piso">Piso / Area a la que visita </label>
                <input type="text" name="piso" id="piso" value="" class="text ui-widget-content ui-corner-all" style="width:13% !important;">
                <input type="text" name="area" id="area" value="" class="text ui-widget-content ui-corner-all" style="width:51% !important;">

                <label for="tiempo">Desde / Hasta</label>
                <input type="text" name="tiempo" id="tiempo" value="" class="text ui-widget-content ui-corner-all" disabled>
                <input type="hidden" name="horaini" id="horaini" value="">
                <input type="hidden" name="horafin" id="horafin" value="">
                <label for="fecha">Fecha</label>
                <input type="text" name="fecha" id="fecha" value="" class="text ui-widget-content ui-corner-all" disabled>

                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
    </div>
    <!-- /.modal -->



@endsection

@section('js')
    <script>
        jQuery.extend(jQuery.validator.messages, {
            required: "Este campo es necesario.",
            remote: "Mejora este campo.",
            email: "Ingresa un email correcto.",
            url: "Ingresa un URL valido.",
            date: "Ingresar un fecha adecuada",
            dateISO: "Ingresar un fecha adecuada (ISO).",
            number: "Ingresa un numero valido.",
            digits: "Ingresa solo digitos.",
            creditcard: "Ingresa un numero de credito correcto.",
            equalTo: "Ingresa los mismos valores.",
            accept: "Ingresa un valor valida.",
            maxlength: jQuery.validator.format("Ingresa como maximo {0} caracteres."),
            minlength: jQuery.validator.format("Ingresa como minimo {0} caracteres."),
            rangelength: jQuery.validator.format("Ingresa un valor entre {0} y {1} caracteres."),
            range: jQuery.validator.format("Ingresa un valor entre {0} y {1}."),
            max: jQuery.validator.format("Ingresa un valor menor a {0}."),
            min: jQuery.validator.format("Ingresa un valor mayor a {0}.")
        });

        $(function() {
            moment.locale("es");
            //console.log(moment.locale());
            var validator = $("#visitaform").validate({
                rules: {
                    dni: {
                        required: true,
                        digits: true,
                        minlength: 8,
                        maxlength: 8,
                    },
                },
                submitHandler: function(form) {
                    // some other code
                    // maybe disabling submit button
                    // then:
                    //$(form).submit();
                    alert("hey");
                    $('#visitaform input[type="submit"]').attr("disable", "disable")
                }
            });

            $('#current_day').text(moment().format('DD/MM/YYYY'));

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
                    $(".dia-selected").removeClass('dia-selected');
                    $( this ).dialog( "close" );
                },
                buttons: {
                    "Registar visita": function() {
                        if($("#visitaform").valid()){

                            $.ajax({ method: "POST", url: "/api/visitas",
                                data: {
                                    area: $("#area").val(),
                                    contacto: $("#contacto").val(),
                                    empresa: $("#empresa").val(),
                                    fecha: $("#fecha").val(),
                                    horaini: $("#horaini").val(),
                                    horafin: $("#horafin").val(),
                                    motivo: $("#motivo").val(),
                                    piso: $("#piso").val(),
                                    dni: $("#dni").val(),
                                    email: $("#dni").val(),
                                    nombre: $("#nombre").val()
                                }
                            }).done(function (msg) {
                                alert(msg.code);

                                validator.resetForm();
                                $(".dia-selected").removeClass('dia-selected');
                                $( this ).dialog( "close" );
                            }.bind(this));

                        }
                    },
                    "Cancelar": function() {
                        validator.resetForm();
                        $(".dia-selected").removeClass('dia-selected');
                        $( this ).dialog( "close" );
                    }
                }
            });

            $('#onemore').click(function () {

                var new_day = moment($('#current_day').text(),'DD/MM/YYYY').add(7,'days');
                var next_day = moment($('#current_day').text(),'DD/MM/YYYY').add(1,'days');
                $('#current_day').text(next_day.format('DD/MM/YYYY'));

                $('.table thead tr').append("<th title='"+new_day.format('DD/MM/YYYY')+"'>" + new_day.format('dddd DD') + "</th>");

                $('.table thead').find("tr").each(function (k, v) {
                    $(this).find("th").eq(1).hide().remove();
                });

                var new_m = moment($('#current_day').text(),'DD/MM/YYYY').add(6,'days');

                $('.table tbody').find("tr").each(function (k, v) {

                    var aux_m = moment(new_m.format('DD_MM_YYYY') + " " +$(this).find("td").eq(0).text(), "DD_MM_YYYY HH:mm");
                    //$(this).append('<td data-day="d_'+aux_m.format('DD_MM_YYYY')+'" data-hour="d_'+aux_m.format('HH_mm')+'">'+aux_m.format('DD/MM/YYYY HH:mm')+'</td>');
                    $(this).append('<td data-day="d_'+aux_m.format('DD_MM_YYYY')+'" data-hour="d_'+aux_m.format('HH_mm')+'"></td>');

                    $(this).find("td").eq(1).hide().remove();

                    $('.table thead').find("tr").last().each(function (key, value) {
                        var aux = moment($('#current_day').text(),'DD/MM/YYYY').add(key,'days').format('DD/MM/YYYY');
                        $(this).find("td:not(.horas)").text( aux + " " + $(this).find("td").eq(0).text());

                    });

                });

                makeclickable($('td[data-day="d_'+new_m.format("DD_MM_YYYY")+'"]'));

            });

            $('#oneless').click(function () {

                var past_day = moment($('#current_day').text(),'DD/MM/YYYY').subtract(1,'days');
                $('#current_day').text(past_day.format('DD/MM/YYYY'));
                $('.table thead').find("tr").each(function (k, v) {
                    $(this).find("th").last().hide().remove();
                    $("<th title='"+past_day.format('DD/MM/YYYY')+"'>"+past_day.format('dddd DD') +"</th>").insertAfter($(this).find("th").eq(0));
                });

                $('.table tbody').find("tr").each(function (k, v) {
                    var aux_m = moment(past_day.format('DD_MM_YYYY') + " " +$(this).find("td").eq(0).text(), "DD_MM_YYYY HH:mm");
                    $(this).find("td").last().hide().remove();
                    //$('<td data-day="d_'+aux_m.format('DD_MM_YYYY')+'" data-hour="d_'+aux_m.format('HH_mm')+'">'+aux_m.format('DD/MM/YYYY HH:mm')+'</td>').insertAfter($(this).find("td").eq(0));
                    $('<td data-day="d_'+aux_m.format('DD_MM_YYYY')+'" data-hour="d_'+aux_m.format('HH_mm')+'"></td>').insertAfter($(this).find("td").eq(0));

                });

                makeclickable($('td[data-day="d_'+past_day.format("DD_MM_YYYY")+'"]'));

            });

            makeclickable($('.table td:not(.horas)'));

            function makeclickable(element) {
                //$('.table td:not(.horas)').on( "click", function () {
                element.click(function () {
                //$('.table td:not(.horas)').click(function () {
                    //console.log(123);

                    if($(".dia-selected").length <1){
                        $(this).addClass('dia-selected');
                    }else if($(".dia-selected").length < 2){
                        if($(this).attr("data-day") == $(".dia-selected").eq(0).attr("data-day")){
                            $(this).addClass('dia-selected');
                            var sel1 = moment($('.dia-selected').eq(0).attr('data-day') +" " +
                                ""+$('.dia-selected').eq(0).attr('data-hour'), "[d]_DD_MM_YYYY [d]_HH_mm" );
                            var sel2 = moment($('.dia-selected').eq(1).attr('data-day') +" " +
                                ""+$('.dia-selected').eq(1).attr('data-hour'), "[d]_DD_MM_YYYY [d]_HH_mm" );

                            $("#fecha").val(sel1.format('DD/MM/YYYY'));
                            $("#tiempo").val(sel1.format('HH:mm')+ " - " +sel2.format('HH:mm'));
                            $("#horaini").val(sel1.format('HH:mm'));
                            $("#horafin").val(sel2.format('HH:mm'));
                            $( "#dialog_new" ).dialog('open');
                        }
                    }
                });
            }

        });

    </script>
@endsection