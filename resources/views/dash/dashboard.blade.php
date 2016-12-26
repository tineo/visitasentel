@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Visitas programadas</div>
                    <div class="panel-body">

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
                                    <th>Horas</th>
                                    @for ($i = 0; $i < 7; $i++)
                                        <th>{{ $days[strftime("%A", $now->getTimestamp())] }}
                                            {{strftime("%d ", $now->getTimestamp()) }}</th>
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
                                        <td>{{ $now->format('d/m/Y H:i') }}</td>
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


    <div class="modal fade" id="myMapModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Ubicacion aproximada</h4>

                </div>
                <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div id="map-canvas"></div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script type='text/javascript' src="http://maps.googleapis.com/maps/api/js?key=AIzaSyABfX5oiHkQu7U4R97CY7Pw66A0dXZAqVM&extension=.js&output=embed"></script>





@endsection