@extends('layouts.app')

@section('content')



    <div  id="main" class="container">
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
                    <div class="panel-heading">Cursos programados
                        <span id="current_day"></span>
                        <span class="sedespan"><b>{{ $sede->getNombre() }}</b></span>
                        <span>({{$sede->getHoraini()->format('H:i')}} - {{$sede->getHorafin()->format('H:i')}})</span>
                    </div>
                    <div class="panel-heading" id="controles" style="opacity:0">
                        <button class="ui-button ui-widget ui-corner-all" id="oneless" ><<</button>
                        <input type="text" id="datepicker">
                        <button class="ui-button ui-widget ui-corner-all" id="onemore">>></button>

                    </div>

                    <div class="panel-body">

                        <div class="table-responsive">

                           <table class="table">

                            <?php
                            setlocale(LC_ALL,"es_ES");
                            date_default_timezone_set('America/Lima');
                            $now = new \DateTime();


                                /*$days = array( "Monday" => "Lunes",
                                        "Tuesday" => "Martes",
                                        "Wednesday" => "Miercoles",
                                        "Thursday" => "Jueves",
                                        "Friday" => "Viernes",
                                        "Saturday" => "Sabado",
                                        "Sunday" => "Domingo"
                                        )*/
                                        $days = array( "Monday" => "Sabado",
                                        "Tuesday" => "Domingo",
                                        "Wednesday" => "Lunes",
                                        "Thursday" => "Martes",
                                        "Friday" => "Miercoles",
                                        "Saturday" => "Jueves",
                                        "Sunday" => "Viernes"
                                        )
                            ?>

                            <thead>
                                <tr>
                                    <th class="horas">Horas</th>
                                    @for ($i = 0; $i < 7; $i++)
                                        <th title="{{strftime("%d/%m/%y", $now->getTimestamp()) }}">{{ $days[strftime("%A", $now->getTimestamp())] }}
                                            {{-- strftime("%d", $now->getTimestamp()) --}}</th>
                                        <?php $now->modify('+1 day')?>
                                    @endfor

                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            //$now = \DateTime::createFromFormat('H:i', $sede["horaini"]);
                            $now = \DateTime::createFromFormat('H:i', $sede->getHoraini()->format('H:i'));
                            //$then = \DateTime::createFromFormat('H:i', $sede["horaini"]);
                            $then = \DateTime::createFromFormat('H:i', $sede->getHoraini()->format('H:i'));
                            //$last = \DateTime::createFromFormat('H:i', $sede["horafin"]);
                            $last = \DateTime::createFromFormat('H:i', $sede->getHorafin()->format('H:i'));
                            //$now = new \DateTime();
                            //$now->setTime(8,0);
                            //$then = new \DateTime();
                            //$then->setTime(8,0);
                            
                            //$then->add(new \DateInterval('PT30M'));
                            $then->add(new \DateInterval('PT60M'));
                            ?>

                            @for ($i = 0; $now < $last; $i++)
                                <tr>

                                    <td class="horas">{{ $now->format('H:i') }} - {{ $then->format('H:i') }}</td>

                                    @for ($j = 0; $j < 7; $j++)
                                        <td
                                                data-day="{{ "d_".$now->format('d_m_Y') }}"
                                                data-hour="{{ "d_".$now->format('H_i') }}"
                                                data-hourfin="{{ "d_".$then->format('H_i') }}"
                                        ></td>
                                        <?php $now->modify('+1 day')?>
                                    @endfor
                                    <?php $now->modify('-7 day')?>
                                </tr>
                                <?php $now->add(new \DateInterval('PT60M')) ?>
                                <?php $then->add(new \DateInterval('PT60M')) ?>

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

    <div id="dialog_new" title="Disponibilidad" >
        @if( (\Illuminate\Support\Facades\Input::get("postpone")) != null )
            <h5>Fecha y hora actual del curso</h5>
            <div>
                <span>{{ $visita->getFecha()->format('d/m/Y') }} </span>
                <span>{{ $visita->getHoraini()->format('H:i') }} / {{ $visita->getHorafin()->format('H:i') }}</span>
            </div>
            <h5>Fecha y hora nueva de la disponibilidad</h5>
            <input type="hidden" name="fecha" id="fecha" value="">
            <input type="hidden" name="horaini" id="horaini" value="">
            <input type="hidden" name="horafin" id="horafin" value="">
            <div><span id="newfecha"></span> <span id="newtiempo"></span></div>
        @else
        <p class="validateTips"></p>
        <h6>Registro de disponibilidad</h6>
        <form id="visitaform">
            <fieldset>
                <!--label for="nombre">Nombre de visita</label--><label for="nombre">Nombre del curso</label>
                <input type="text" name="nombre" id="nombre" value="" class="text ui-widget-content ui-corner-all" required>
                <!--label for="dni">DNI de visita</label--> <label for="dni">Ingrese Código de profesor</label>
                <input type="text" name="dni" id="dni" value="" class="text ui-widget-content ui-corner-all">
                <!--label for="empresa">Email de visita</label--><label for="empresa">comentario</label>
                <input type="text" name="email" id="email2" value="" class="text ui-widget-content ui-corner-all">
                <!--label for="empresa">Empresa de visita</label>
                <input type="hidden" name="empresa" id="empresa" value="" class="text ui-widget-content ui-corner-all">
                <label for="motivo">Motivo</label>
                <input type="text" name="motivo" id="motivo" value="" class="text ui-widget-content ui-corner-all">
                <label for="contacto">Contacto Entel</label>
                <input type="text" name="contacto" id="contacto" value="" class="text ui-widget-content ui-corner-all">
                <label for="piso">Piso / Area a la que visita </label>
                <input type="text" name="piso" id="piso" value="" class="text ui-widget-content ui-corner-all" style="width:13% !important;">
                <input type="text" name="area" id="area" value="" class="text ui-widget-content ui-corner-all" style="width:51% !important;">

                <label for="tiempo">Desde / Hasta</label>
                <input type="text" name="tiempo" id="tiempo" value="" class="text ui-widget-content ui-corner-all" disabled>

                <label for="fecha">Fecha</label>
                <input type="text" name="fecha" id="fecha" value="" class="text ui-widget-content ui-corner-all" disabled>
                <input type="hidden" name="horaini" id="horaini" value="">
                <input type="hidden" name="horafin" id="horafin" value="">
                 Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
        @endif
    </div>
    <!-- /.modal -->

    <div id="dialog_adv" title="Advertencia">
        <p>Este horario no es disponible.</p>
    </div>
    <!-- Initial overlay not by jquery-->
    <!--<div id="overlay"><img src="/images/entel.png"/></div>-->

@endsection

@section('js')
    <script>

        $(function() {

            moment.locale("es");

            $('#current_day').text(moment().format('DD/MM/YYYY'));
            $('#datepicker').val(moment().format('DD/MM/YYYY'));

            var datePicker =  $( "#datepicker" ).datepicker({
                dateFormat: 'dd/mm/yy',
                onSelect: function(dateText, inst) {
                    $(".dia-selected").removeClass("dia-selected");
                    $('#current_day').text( $('#datepicker').val() );

                    $.when().then(function(){
                        for(var i=0; i<7; i++) {
                            $('.table thead tr th').eq(1).remove();
                        }
                        var next_day = moment($('#current_day').text(), 'DD/MM/YYYY');
                        for(var i=0; i<7; i++) {
                            $('.table thead tr').append("<th title='" + next_day.format('DD/MM/YYYY') + "'>" + next_day.format('dddd DD') + "</th>");
                            next_day.add(1, 'days');
                        }

                        var cur_day = moment($('#current_day').text(), 'DD/MM/YYYY');
                        cur_day.hours(8);
                        cur_day.minutes(0);
                        $('.table tbody tr').each(function (k,v) {
                            $(this).find("td").not(".horas").each(function (ke,va) {
                                //$(this).text(cur_day.format('DD/MM/YYYY HH:mm'));
                                $(this).attr("data-day","d_"+cur_day.format('DD_MM_YYYY'));
                                $(this).attr("data-hour","d_"+cur_day.format('HH_mm'));
                                cur_day.add(30, 'minutes');
                                $(this).attr("data-hourfin","d_"+cur_day.format('HH_mm'));
                                cur_day.subtract(30, 'minutes');
                                cur_day.add(1, 'days');

                            });
                            cur_day.add(30, 'minutes');

                            cur_day.subtract(7, 'days');

                        });

                        $('.table tbody tr td').removeClass("nodisponible");
                    }).then(function () {

                        //var overlay = jQuery('<div id="overlay"></div>');
                        //overlay.appendTo(document.body);

                        $.ajax({ method: "POST", url: "/api/visitas/bydate",
                            data: {
                                fecha: $('#current_day').text(),
                                offset: 7
                            }
                        }).done(function (msg) {

                            $.each(msg,function (k,v) {

                                var hini = moment(v.horaini.date);
                                var hfin = moment(v.horafin.date);

                                var curini = moment(v.fecha.date);
                                curini.hour(hini.hour());
                                curini.minute(hini.minute());

                                var curfin = moment(v.fecha.date);
                                curfin.hour(hfin.hour());
                                curfin.minute(hfin.minute());

                                $('td[data-day="d_'+curini.format("DD_MM_YYYY")+'"').each(function (k,v) {
                                    var cur = moment(curini.format("DD_MM_YYYY")+" "+$(this).attr('data-hour'), "DD_MM_YYYY HH:mm");
                                    if((cur.isAfter(curini) && cur.isBefore(curfin)) || cur.isSame(curini)){ $(this).addClass("nodisponible");}

                                });

                            });

                            /*overlay.fadeOut( "slow", function() {
                                $( this ).remove();
                            });*/

                        }.bind(this));
                    }.bind(this));
                }
            });

            var isMobile = window.matchMedia("only screen and (max-width: 760px)");

            if (!isMobile.matches) {
                $(window).resize(function() {
                    datePicker.datepicker('hide');
                    $('#datepicker').blur();
                });
            }
            $( "#datepicker" ).datepicker({ dateFormat: 'dd/mm/yy'});

            var validator = $("#visitaform").validate({
                rules: {
                    dni: {
                        required: true,
                        digits: true,
                        minlength: 8,
                        maxlength: 8,
                    },
                    email: {
                        required: false,
                        email: false
                    }
                },
                submitHandler: function(form) {
                    $('#visitaform input[type="submit"]').attr("disable", "disable");
                }
            });
            //var overlay0 = $('#overlay');

            $.ajax({ method: "POST", url: "/api/visitas/bydate",
                data: {
                    fecha: $("#current_day").text(),
                    offset: 7
                }
            }).done(function (msg) {

                $.each(msg,function (k,v) {

                    var hini = moment(v.horaini.date);
                    var hfin = moment(v.horafin.date);

                    var curini = moment(v.fecha.date);
                    curini.hour(hini.hour());
                    curini.minute(hini.minute());

                    var curfin = moment(v.fecha.date);
                    curfin.hour(hfin.hour());
                    curfin.minute(hfin.minute());

                    $('td[data-day="d_'+curini.format("DD_MM_YYYY")+'"').each(function (k,v) {
                        var cur = moment(curini.format("DD_MM_YYYY")+" "+$(this).attr('data-hour'), "DD_MM_YYYY HH:mm");
                        if((cur.isAfter(curini) && cur.isBefore(curfin)) || cur.isSame(curini)){ $(this).addClass("nodisponible");}

                    });

                });
                //overlay0.fadeOut( "slow", function() {
                //    $( this ).remove();
                //});

            }.bind(this));

            $( "#dialog_adv" ).dialog({
                autoOpen: false,
                resizable: false,
                height: "auto",
                width: 250,
                modal: true,
                show: {
                    effect: "shake",
                    duration: 600
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
                    if($("#visitaform").length > 0) validator.resetForm();
                    $(".dia-selected").removeClass('dia-selected');
                    $( this ).dialog( "close" );
                },
                buttons: {
                    @if( (\Illuminate\Support\Facades\Input::get("postpone")) != null )
                    "Postergar visita": function(event) {
                        $(event.target).prop('disabled', true);

                        $.ajax({ method: "PUT", url: "api/visitas/{{ $visita->getIdvisita() }}",
                            data: {
                                fecha: $("#fecha").val(),
                                horaini: $("#horaini").val(),
                                horafin: $("#horafin").val()
                            }
                        }).done(function (msg) {


                            $('#current_day').text( $('#datepicker').val() );

                            $.when().then(function(){
                                for(var i=0; i<7; i++) {
                                    $('.table thead tr th').eq(1).remove();
                                }
                                var next_day = moment($('#current_day').text(), 'DD/MM/YYYY');
                                for(var i=0; i<7; i++) {
                                    $('.table thead tr').append("<th title='" + next_day.format('DD/MM/YYYY') + "'>" + next_day.format('dddd DD') + "</th>");
                                    next_day.add(1, 'days');
                                }

                                var cur_day = moment($('#current_day').text(), 'DD/MM/YYYY');
                                cur_day.hours(8);
                                cur_day.minutes(0);
                                $('.table tbody tr').each(function (k,v) {
                                    $(this).find("td").not(".horas").each(function (ke,va) {
                                        //$(this).text(cur_day.format('DD/MM/YYYY HH:mm'));
                                        $(this).attr("data-day","d_"+cur_day.format('DD_MM_YYYY'));
                                        $(this).attr("data-hour","d_"+cur_day.format('HH_mm'));
                                        cur_day.add(30, 'minutes');
                                        $(this).attr("data-hourfin","d_"+cur_day.format('HH_mm'));
                                        cur_day.subtract(30, 'minutes');
                                        cur_day.add(1, 'days');

                                    });
                                    cur_day.add(30, 'minutes');

                                    cur_day.subtract(7, 'days');

                                });

                                $('.table tbody tr td').removeClass("nodisponible");
                            }).then(function () {

                                //var overlay = jQuery('<div id="overlay"><img src="/images/entel.png"/></div>');
                                //overlay.appendTo(document.body);

                                $.ajax({ method: "POST", url: "/api/visitas/bydate",
                                    data: {
                                        fecha: $('#current_day').text(),
                                        offset: 7
                                    }
                                }).done(function (msg) {

                                    $.each(msg,function (k,v) {

                                        var hini = moment(v.horaini.date);
                                        var hfin = moment(v.horafin.date);

                                        var curini = moment(v.fecha.date);
                                        curini.hour(hini.hour());
                                        curini.minute(hini.minute());

                                        var curfin = moment(v.fecha.date);
                                        curfin.hour(hfin.hour());
                                        curfin.minute(hfin.minute());

                                        $('td[data-day="d_'+curini.format("DD_MM_YYYY")+'"').each(function (k,v) {
                                            var cur = moment(curini.format("DD_MM_YYYY")+" "+$(this).attr('data-hour'), "DD_MM_YYYY HH:mm");
                                            if((cur.isAfter(curini) && cur.isBefore(curfin)) || cur.isSame(curini)){ $(this).addClass("nodisponible");}

                                        });

                                    });

                                    //overlay.fadeOut( "slow", function() {
                                    //    $( this ).remove();
                                    //});

                                }.bind(this));
                            }.bind(this));


                            $( this ).dialog( "close" );

                            $(event.target).prop('disabled', false);
                        }.bind(this));
                    },
                    @else
                    "Registar visita": function(event) {


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
                                    email: $("#email2").val(),
                                    nombre: $("#nombre").val()
                                }
                            }).done(function (msg) {
                                var dataday = $('.dia-selected').attr('data-day');
                                var ini = moment(dataday+" "+$("#horaini").val(), "DD_MM_YYYY HH:mm");
                                var fin = moment(dataday+" "+$("#horafin").val(), "DD_MM_YYYY HH:mm");

                                $('td[data-day="'+dataday+'"').each(function (k,v) {
                                    var cur = moment(dataday+" "+$(this).attr('data-hour'), "DD_MM_YYYY HH:mm");

                                    if((cur.isAfter(ini) && cur.isBefore(fin)) || cur.isSame(ini)){
                                        $(this).addClass("nodisponible");
                                    }

                                });

                                validator.resetForm();
                                $(".dia-selected").removeClass('dia-selected');
                                $( this ).dialog( "close" );
                                $(event.target).prop('disabled', false);
                            }.bind(this));

                        }
                    },

                    "Cancelar": function() {
                        validator.resetForm();
                        $(".dia-selected").removeClass('dia-selected');
                        $( this ).dialog( "close" );
                    }
                    @endif

                }
            });

            $('#onemore').click(function (event) {
                $(event.target).prop('disabled', true);

                var new_day = moment($('#current_day').text(),'DD/MM/YYYY').add(7,'days');
                var next_day = moment($('#current_day').text(),'DD/MM/YYYY').add(1,'days');
                $('#current_day').text(next_day.format('DD/MM/YYYY'));
                $('#datepicker').val(next_day.format('DD/MM/YYYY'));

                $('.table thead tr').append("<th title='"+new_day.format('DD/MM/YYYY')+"'>" + new_day.format('dddd DD') + "</th>");

                $('.table thead').find("tr").each(function (k, v) {
                    $(this).find("th").eq(1).hide().remove();
                });

                var new_m = moment($('#current_day').text(),'DD/MM/YYYY').add(6,'days');

                $('.table tbody').find("tr").each(function (k, v) {

                    var aux_m = moment(new_m.format('DD_MM_YYYY') + " " +$(this).find("td").eq(0).text(), "DD_MM_YYYY HH:mm");
                    var aux_mf = moment(new_m.format('DD_MM_YYYY') + " " +$(this).find("td").eq(0).text(), "DD_MM_YYYY HH:mm").add(30, 'minutes');
                    //$(this).append('<td data-day="d_'+aux_m.format('DD_MM_YYYY')+'" data-hour="d_'+aux_m.format('HH_mm')+'">'+aux_m.format('DD/MM/YYYY HH:mm')+'</td>');
                    $(this).append('<td data-day="d_'+aux_m.format('DD_MM_YYYY')+'" data-hour="d_'+aux_m.format('HH_mm')+'" data-hourfin="d_'+aux_mf.format('HH_mm')+'"></td>');

                    $(this).find("td").eq(1).hide().remove();

                    $('.table thead').find("tr").last().each(function (key, value) {
                        var aux = moment($('#current_day').text(),'DD/MM/YYYY').add(key,'days').format('DD/MM/YYYY');
                        $(this).find("td:not(.horas)").text( aux + " " + $(this).find("td").eq(0).text());

                    });

                });


                $.when($.ajax({ method: "POST", url: "/api/visitas/bydate",
                    data: {
                        fecha: new_day.format('DD/MM/YYYY'),
                        offset: 1
                    }
                }).done(function (msg) {

                    $.each(msg,function (k,v) {

                        var hini = moment(v.horaini.date);
                        var hfin = moment(v.horafin.date);

                        var curini = moment(v.fecha.date);
                        curini.hour(hini.hour());
                        curini.minute(hini.minute());

                        var curfin = moment(v.fecha.date);
                        curfin.hour(hfin.hour());
                        curfin.minute(hfin.minute());

                        $('td[data-day="d_'+curini.format("DD_MM_YYYY")+'"').each(function (k,v) {
                            var cur = moment(curini.format("DD_MM_YYYY")+" "+$(this).attr('data-hour'), "DD_MM_YYYY HH:mm");
                            if((cur.isAfter(curini) && cur.isBefore(curfin)) || cur.isSame(curini)){ $(this).addClass("nodisponible");}

                        });


                    }.bind(this))

                }.bind(this))).then(function(){
                    $(event.target).prop('disabled', false);
                    makeclickable($('td[data-day="d_'+new_m.format("DD_MM_YYYY")+'"]'));
                });


            });

            $('#oneless').click(function (event) {
                $(event.target).prop('disabled', true);
                var past_day = moment($('#current_day').text(),'DD/MM/YYYY').subtract(1,'days');
                $('#current_day').text(past_day.format('DD/MM/YYYY'));
                $('#datepicker').val(past_day.format('DD/MM/YYYY'));
                $('.table thead').find("tr").each(function (k, v) {
                    $(this).find("th").last().hide().remove();
                    $("<th title='"+past_day.format('DD/MM/YYYY')+"'>"+past_day.format('dddd DD') +"</th>").insertAfter($(this).find("th").eq(0));
                });

                $('.table tbody').find("tr").each(function (k, v) {
                    var aux_m = moment(past_day.format('DD_MM_YYYY') + " " +$(this).find("td").eq(0).text(), "DD_MM_YYYY HH:mm");
                    var aux_mf = moment(aux_m.format('DD_MM_YYYY') + " " +$(this).find("td").eq(0).text(), "DD_MM_YYYY HH:mm").add(30, 'minutes');
                    $(this).find("td").last().hide().remove();
                    $('<td data-day="d_'+aux_m.format('DD_MM_YYYY')+'" data-hour="d_'+aux_m.format('HH_mm')+'" data-hourfin="d_'+aux_mf.format('HH_mm')+'"></td>').insertAfter($(this).find("td").eq(0));

                });

                $.when($.ajax({ method: "POST", url: "/api/visitas/bydate",
                    data: {
                        fecha: past_day.format('DD/MM/YYYY'),
                        offset: 1
                    }
                }).done(function (msg) {

                    $.each(msg,function (k,v) {

                        var hini = moment(v.horaini.date);
                        var hfin = moment(v.horafin.date);

                        var curini = moment(v.fecha.date);
                        curini.hour(hini.hour());
                        curini.minute(hini.minute());

                        var curfin = moment(v.fecha.date);
                        curfin.hour(hfin.hour());
                        curfin.minute(hfin.minute());

                        $('td[data-day="d_'+curini.format("DD_MM_YYYY")+'"').each(function (k,v) {
                            var cur = moment(curini.format("DD_MM_YYYY")+" "+$(this).attr('data-hour'), "DD_MM_YYYY HH:mm");
                            if((cur.isAfter(curini) && cur.isBefore(curfin)) || cur.isSame(curini)){ $(this).addClass("nodisponible");}

                        });


                    })

                }.bind(this))).then(function () {
                    $(event.target).prop('disabled', false);
                    makeclickable($('td[data-day="d_'+past_day.format("DD_MM_YYYY")+'"]'));
                });

            });

            makeclickable($('.table td:not(.horas)'));

            function makeclickable(element) {

                element.click(function (event) {

                    if($(event.target).hasClass('nodisponible')){

                        $("#dialog_adv").dialog('open');

                    }else {

                        if ($(".dia-selected").length < 1) {
                            $(this).addClass('dia-selected');
                        } else if ($(".dia-selected").length < 2) {
                            if ($(this).attr("data-day") == $(".dia-selected").eq(0).attr("data-day")) {
                                $(this).addClass('dia-selected');

                                var sel1 = moment($('.dia-selected').eq(0).attr('data-day') + " " +
                                    "" + $('.dia-selected').eq(0).attr('data-hour'), "[d]_DD_MM_YYYY [d]_HH_mm");

                                if($(".dia-selected").length > 1) {

                                    var inis = moment($('.dia-selected').eq(0).attr('data-day') + " " +
                                        "" + $('.dia-selected').eq(0).attr('data-hour'), "[d]_DD_MM_YYYY [d]_HH_mm");

                                    var fins = moment($('.dia-selected').eq(1).attr('data-day') + " " +
                                        "" + $('.dia-selected').eq(1).attr('data-hour'), "[d]_DD_MM_YYYY [d]_HH_mm");
                                    do{
                                        inis.add(30,"minutes");

                                        $("td[data-hour='d_"+inis.format('HH_mm')+"']").each(function (kee,vaa) {
                                            if($(this).attr("data-day") == inis.format("[d]_DD_MM_YYYY")){

                                                if($(this).hasClass("nodisponible")){
                                                    $("#dialog_adv").dialog('open');
                                                    $(".dia-selected").removeClass('dia-selected');
                                                    return;
                                                }
                                            }
                                        })
                                    }
                                    while (! inis.isSame(fins));

                                    var sel2 = moment($('.dia-selected').eq(1).attr('data-day') + " " +
                                        "" + $('.dia-selected').eq(1).attr('data-hourfin'), "[d]_DD_MM_YYYY [d]_HH_mm");

                                }else{
                                    var sel2 = moment($('.dia-selected').eq(0).attr('data-day') + " " +
                                        "" + $('.dia-selected').eq(0).attr('data-hourfin'), "[d]_DD_MM_YYYY [d]_HH_mm");
                                }

                                if(!$('#dialog_adv').dialog('isOpen')) {
                                    @if( (\Illuminate\Support\Facades\Input::get("postpone")) == null )
                                    $("#fecha").val(sel1.format('DD/MM/YYYY'));
                                    $("#tiempo").val(sel1.format('HH:mm') + " - " + sel2.format('HH:mm'));
                                    $("#horaini").val(sel1.format('HH:mm'));
                                    $("#horafin").val(sel2.format('HH:mm'));
                                    @else
                                    $("#fecha").val(sel1.format('DD/MM/YYYY'));
                                    $("#horaini").val(sel1.format('HH:mm'));
                                    $("#horafin").val(sel2.format('HH:mm'));

                                    $("#newfecha").text(sel1.format('DD/MM/YYYY'));
                                    $("#newtiempo").text(sel1.format('HH:mm') + " - " + sel2.format('HH:mm'));
                                    @endif
                                    $("#dialog_new").dialog('open');
                                }
                            }
                        }
                    }
                });

            }

        });

    </script>
@endsection