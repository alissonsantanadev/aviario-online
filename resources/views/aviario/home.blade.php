@extends('layouts.app')

@section('content')
    <section class="content-child aviario-home">
        <a href="">
            <article class="ultimo-post">
                <h6>{{$ultimoPost->categoria->descricao}}</h6>
                <h2> {{$ultimoPost->titulo}} </h2>
                <p class="mt-1"> {{$ultimoPost->previa}} </p>
            </article>
        </a>
        <hr>
        <section class="row justify-content-between">
            
            <article class="col-md-6 pr-0">
                <a href="">
                    <div class="penultimo-post">
                        <img src="{{ url('storage/imagens/chamadas/'.$penultimoPost->imagem) }}" />
                        <div class="titulo-post">
                            <h6> {{$penultimoPost->categoria->descricao}} </h6>
                            <h4> {{$penultimoPost->titulo}} </h4>
                        </div>
                    </div>
                </a>
            </article>
            
    
            <article class="col-md-6 p-0">
                @foreach ($posts as $post)
                    <a href="">
                        <article class="col-md-12 p-0 row posts-laterais">
                            <div class="col-6">
                                <img src="{{ url('storage/imagens/chamadas/'.$post->imagem) }}" />
                            </div>
                            <div class="col-6 teste">
                                <h6> {{$post->categoria->descricao}} </h6>
                                <h4> {{$post->titulo}} </h4>
                                <div class="mt-1 previa">
                                    <p> {{$post->previa}}  </p>
                                </div>
                            </div>
                        </article>
                    </a>
                @endforeach
            </article>
        </section>
        <hr>
    </section>

@endsection
