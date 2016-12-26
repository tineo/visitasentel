@extends('layouts.app')

@section('content')


    <script>

        function initialize() {
            var mapOptions = {
                center: new google.maps.LatLng(51.219987, 4.396237),
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("mapCanvas"),
                    mapOptions);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(51.219987, 4.396237)
            });
            marker.setMap(map);
        }

    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Registros recibidos</div>
                    <div class="panel-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Codigo</th>
                                    <th>Tienda</th>
                                    <th>Observacion</th>
                                    <th>Latitud</th>
                                    <th>Longitud</th>
                                    <th>Numero</th>
                                    <th>Usuario</th>
                                    <th>Fecha y hora de reg.</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($tracks as $track)
                                <tr>
                                    <td> {{ $track->getId() }}</td>
                                    <td> {{ $track->getCodigo() }}</td>
                                    @if(is_null($track->getIdTienda()))
                                        <td> ???? </td>
                                    @else
                                        <td> {{ $track->getIdTienda()->getName() }}</td>
                                    @endif
                                    <td> {{ $track->getObs() }}</td>
                                    <td> <a href="#" data-lat="{{$track->getLat()}},{{ $track->getLng() }}"
                                            data-toggle="modal" data-target="#myMapModal">{{ $track->getLat() }}</a></td>
                                    <td> <a href="#" data-lat="{{$track->getLat()}},{{ $track->getLng() }}"
                                            data-toggle="modal" data-target="#myMapModal">{{ $track->getLng() }}</a></td>
                                    <td> {{ $track->getNum() }}</td>
                                    <td> {{ $track->getUsr() }}</td>
                                    <td> {{ $track->getDtime()->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            @endforeach
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



    <script type='text/javascript'>
        var element = $(this);
        var map;

        function initialize(myCenter) {
            var marker = new google.maps.Marker({
                position: myCenter
            });

            var mapProp = {
                center: myCenter,
                zoom: 15,
                //draggable: false,
                //scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("map-canvas"), mapProp);
            marker.setMap(map);
        };
    </script>

    <script type='text/javascript'>

        $('#myMapModal').on('shown.bs.modal', function(e) {
            console.log(123);
            var element = $(e.relatedTarget);
            var data = element.data("lat").split(',')
            initialize(new google.maps.LatLng(data[0], data[1]));
        });

    </script>


@endsection