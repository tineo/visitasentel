<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <style>
        ul, ul li{
            margin: 0;
            padding: 0;
        }
    </style>

</head>
<body>

    <h2> Se ha confirmado la asistencia.</h2>
    <h3>Contacto</h3>
    <div>{{ $visita->getContacto() }}</div>
    <h3>Piso</h3>
    <div>{{ $visita->getPiso() }}</div>
    <h3>Fecha</h3>
    <div>{{ $visita->getFecha()->format('d/m/Y') }}</div>
    <h3>Hora inicio / Hora fin</h3>
    <div>{{ $visita->getHoraini()->format('H:i') }} / {{ $visita->getHorafin()->format('H:i') }}</div>

    @foreach ($asistentes as $asistente)
        @if($asistente['tipo'] == 1)
            <h4>Registrante</h4>
            <ul>
                <li>{{ $asistente["nombre"] }} / {{ $asistente["empresa"] }} ({{ $asistente["email"] }})</li>
            </ul>
        @else
        @endif
    @endforeach


    @if( count($asistentes) > 1 )
        <h4>Acompañantes</h4>
        <ul>
        @foreach ($asistentes as $asistente)
            @if($asistente['tipo'] == 1)

            @else
                <li>{{ $asistente["nombre"] }} / {{ $asistente["empresa"] }} ({{ $asistente["email"] }})</li>
            @endif
        @endforeach
        </ul>
    @endif


</body>
</html>