@extends('layouts.app')

@section('content')    
    <section class="padding-padrao empresas-por-categoria ">
        <article class="row justify-content-between px-md-3">
            <div class="col-sm-12 px-md-0 titulo-pagina">
                <h2> Guia Comercial / {{$categoria->descricao}} </h2>
                <hr class="">
            </div>
        
        </article>
        @csrf

        <section class="row pl-md-3 justify-content-between">
            <article class="col-12 col-md-9 px-md-0">
                <ul class="">
                    @foreach ($empresas as $emp)
                        <li>
                            <a href="#">
                                <section class="row col-sm-12 mx-0 px-0">
                                    <article class="imagem-comercio col-4 col-md-2 col-xl-3 px-0 mr-0">
                                        <img src="{{ url('storage/imagens/empresas/'.$emp->imagem)}}"/>
                                    </article>

                                    <article class="info-comercio col-8 col-md-10 col-xl-9 pl-2 pl-md-0 px-0 py-md-4 d-flex align-content-around flex-wrap">
                                        <div class="nome col-12 px-0">
                                            <h4> {{$emp->nome}} </h4>
                                            <p class="d-none d-sm-block"> {{$emp->slogan}} </p>
                                        </div>
                                        <div class="endereco col-12 px-0">
                                            <p>
                                                @if($emp->endereco->logradouro)
                                                    {{$emp->endereco->logradouro}} ,
                                                @endif
                                                @if ($emp->endereco->numero)
                                                    {{$emp->endereco->numero}}
                                                @endif
                                            </p>

                                            <p>
                                                {{$emp->endereco->bairro}} -

                                                @if ($emp->endereco->cep)
                                                    {{$emp->endereco->rua}} -
                                                @endif

                                                Feira de Santana/BA
                                            </p>
                                        </div>

                                        <div class="contatos col-12 px-0">
                                            <h4> {{$emp->telefone}} </h4>
                                        </div>
                                    </article>
                                    
                                    <hr class="col-11 px-md-0 mx-md-0">
                                </section>
                            </a> 
                        </li>
                    @endforeach
                </ul>
            </article>   

            <article class="col-md-3 anuncios-laterais">
                @foreach ($bannersQuadrados as $banner)
                    <div class="col-12 anuncio px-0 mb-5">
                        <img src="{{ url('storage/imagens/banners/'.$banner->imagem) }}" />
                    </div>    
                @endforeach
            </article>
        </section>
    </section>
@endsection