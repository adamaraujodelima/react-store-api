@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Usuários</div>

                <div class="card-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                        <a class="btn btn-primary" href="{{route('admin-users-new')}}">NOVO</a>
                    </div>

                    <div class="col-md-12 mt-3">
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>                                    
                                    <th>E-mail</th>                                    
                                    <th>Perfil</th>
                                    <th>Criado em</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($users) > 0)
                                @foreach ($users as $user)
                                    <tr>
                                    <td>{{ $user->id}}</td>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ ($user->profile == 1) ? 'Administrador' : 'Usuário' }}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($user->created_at)) }}</td>                                    
                                    <td>
                                    <a href="{{route('admin-users-edit', [ 'id' => $user->id] )}}">Editar</a>
                                    <a href="{{route('admin-users-remove', [ 'id' => $user->id] )}}">Remover</a>
                                    </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="4">Nenhum post cadastrado até o momento</td></tr>
                            @endif
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
