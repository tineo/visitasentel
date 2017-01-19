@extends('layouts.app')

@section('content')
<div id="main" class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <ul>
                    @foreach($roles as $role)
                        <li>{{ $role->getName() }}</li>
                    @endforeach

                        @foreach($sedes as $sede)
                            <li>{{ $sede->getNombre() }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
