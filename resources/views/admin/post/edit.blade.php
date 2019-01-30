@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Post</div>

                <div class="card-body">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('admin-posts-edit', [ 'id' => $post->id ]) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Imagem') }}</label>

                                <div class="col-md-6">

                                    <div class="image col-xs-12 mb-3">
                                        @if($post->image)
                                        <img width="260" src="{{ url('storage/' . $post->image) }}" alt="{{ $post->name }}">
                                        @else
                                        <img src="http://placehold.it/260x180" alt="">
                                        @endif
                                    </div>
                                    
                                    <input type="file" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{ old('image', $post->image) }}">

                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Título') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $post->title) }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="published" class="col-md-4 col-form-label text-md-right">{{ __('Publicado') }}</label>

                                <div class="col-md-6">
                                    <select name="published" id="published" class="form-control{{ $errors->has('published') ? ' is-invalid' : '' }}" required autofocus>
                                    @if(old('published', $post->published))
                                        <option value="0">Não</option>
                                        <option value="1" selected>Sim</option>
                                    @else
                                        <option value="0" selected>Não</option>
                                        <option value="1">Sim</option>
                                    @endif
                                    </select>

                                    @if ($errors->has('published'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('published') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Conteúdo') }}</label>

                                <div class="col-md-6">
                                    <textarea name="content" id="content" cols="30" rows="10" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" required>{{ old('content', $post->content) }}</textarea>

                                    @if ($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                            

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Salvar') }}
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('admin-posts-list') }}" enctype="multipart/form-data">
                                        {{ __('Cancelar') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
