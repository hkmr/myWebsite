@extends('main')

@section('title' , 'Read and write yout favorite stories ')

@section('description' , '"Welcome to twebox, a place to read, write, and interact with the stories that matter most to you. Every day, thousands of read, write, and share important stories on twebox.')


@section('content')

<div class="uk-container">
    
    @if(!Auth::check())
    {{-- Welcome Message --}}
    <div uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <div class="uk-padding-small">
        <i uk-icon="icon: info; ratio: 1.5"></i>
        <span class="uk-text-middle uk-text-large" id="type-it"> Welcome to twebox. <br> We Are happy to have you here.</span>
        <p>Read and write all your favorite stories ...</p>
        </div>
    </div>
    @endif

    @include('pages.welcome.latest')

    @include('pages.welcome.weeks_trending')

    @include('pages.welcome.category')

    @include('pages.welcome.recommended')

</div>

@endsection