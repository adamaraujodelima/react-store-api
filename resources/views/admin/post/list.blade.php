@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts</div>

                <div class="card-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                        <a class="btn btn-primary" href="{{route('admin-posts-new')}}">NOVO</a>
                    </div>

                    <div class="col-md-12 mt-3">
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Imagem</th>
                                    <th>Titulo</th>                                    
                                    <th>Autor</th>
                                    <th>Criado em</th>
                                    <th>Publicado em</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($posts) > 0)
                                @foreach ($posts as $post)
                                    <tr>
                                    <td>{{ $post->id}}</td>
                                    <td>
                                        @if($post->image)
                                            <img width="100" src="{{ url('storage/' . $post->image) }}" alt="{{ $post->name }}">
                                        @else
                                            <img width="100" src="http://placehold.it/260x180" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $post->title}}</td>
                                    <td>{{ $post->user->name}}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($post->created_at)) }}</td>
                                    <td>{{ ($post->published) ? date('d/m/Y H:i:s', strtotime($post->posted_at)) : 'Não publicado' }}</td>
                                    <td>
                                    <a href="{{route('admin-posts-edit', [ 'id' => $post->id] )}}">Editar</a>
                                    <a href="{{route('admin-posts-remove', [ 'id' => $post->id] )}}">Remover</a>
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
