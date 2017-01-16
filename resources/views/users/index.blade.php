@extends('layouts.app')

@section('content')
    <div  id="main" class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div class="row">
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <h3>Usuarios</h3>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-4">
                                <div class="btn-group">
                                    <a href="/register">
                                        <button type="button" class="btn btn-default">
                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                                            <span> Agregar usuario </span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td> {{ $user->getId() }}</td>
                                        <td> {{ $user->getName() }}</td>
                                        <td> {{ $user->getEmail() }}</td>
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