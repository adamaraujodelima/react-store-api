@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Meus Posts</div>

                <div class="card-body">
                    <div class="row justify-content-center">                        
                        <div class="col-md-12 mt-3">                        
                        @if(count($posts) > 0)
                            @foreach ($posts as $post)
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h4><strong><a href="{{ route('post-info', [ 'id' =>  $post->id ])}}">{{ $post->title }}</a></strong></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <a href="{{route('post-info',['id' => $post->id]) }}" class="thumbnail">
                                                @if($post->image)
                                                <img width="260" src="{{ url('storage/' . $post->image) }}" alt="{{ $post->name }}">
                                                @else
                                                <img src="http://placehold.it/260x180" alt="">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="col-md-7 p-1">      
                                            <p>{!! substr($post->content, 0, 300) !!} ...</p>
                                            <p><a href="{{route('post-info',['id' => $post->id]) }}">Leia mais</a></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p></p>
                                            <p>
                                            <i class="icon-user"></i> por <a href="#">{{ $post->user->name }}</a> 
                                            | <i class="icon-calendar"></i> Criado em: {{ date('d/m/Y H:i:s', strtotime($post->created_at)) }}
                                            | <i class="icon-calendar"></i> Publicado em: {{ date('d/m/Y H:i:s', strtotime($post->posted_at)) }}
                                            | <i class="icon-calendar"></i> Última atualização: {{ date('d/m/Y H:i:s', strtotime($post->created_at)) }}
                                            | <a href="{{ route('user-posts-edit', [ 'id' => $post->id])}}"><span class="label label-info">Editar</span></a> 
                                            | <a href="{{ route('user-posts-remove', [ 'id' => $post->id])}}"><span class="label label-info">Excluir</span></a>                                             
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <strong>Você não publicou nada até agora :(</strong>
                            </div>
                        @endif                            
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
