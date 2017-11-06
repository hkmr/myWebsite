@extends('main')

@section('title', 'Category List')

@section('description', 'twebox all categories related to stories')

@section('content')

    <div class="uk-container uk-margin-xlarge-top">

        <div>
            <h2 class="uk-heading-primary">Categories List</h2>
            <hr class="uk-divider-small">
        </div>

        @if(Auth::check() && Auth::user()->email == "harsh@gmail.com")
        <div class="uk-margin">

            {!! Form::open([ 'route' => 'categories.store', 'method' => 'POST' ,'files' => true]) !!}
                <span class="uk-text-lead uk-margin-right">Add New Category : </span>
                <span class="uk-margin-right">
                    {{ Form::text('name', null , ['class' => 'uk-input uk-form-width-medium' , 'placeholder' => 'Category Name']) }}
                </span>
                <span class="uk-margin-right">
                    <div uk-form-custom>
                        {{ Form::file('featured_image') }}
                        <button class="uk-button uk-button-default" type="button" tabindex="-1">Select Image</button>
                    </div>
                </span>
                <span class="uk-margin-right">
                    {{-- <input type="submit" value="ADD" class="uk-button uk-button-primary"> --}}
                    {{ Form::submit('ADD', ['class' => 'uk-button uk-button-primary']) }}
                </span>
            {!! Form::close() !!}

        </div>
        <hr>
        @endif
        <div class="uk-child-width-1-4@m uk-text-center" uk-grid>

            @foreach( $categories as $category )
            <div class="uk-padding-small">
                <div class="uk-inline uk-light uk-margin uk-inline-clip uk-transition-toggle">

                    <img class="uk-transition-scale-up uk-transition-opaque" src="/images/categories/{{ $category->image }}" alt="">
                    <div class="uk-overlay-primary uk-position-cover"></div>
                    <div class="uk-position-center">
                        <a class="uk-link-reset" href="{{'/category/'.$category->name }}">
                            <span class="uk-text-large uk-text-bold uk-text-uppercase"> {{ $category->name }} </span>
                        </a><br>
                        <small class="uk-text-meta">{{$category->total_posts}} Stories</small>
                        <follow
                        :category ={{ $category->id }}
                        :followed = {{ $category->followed() ? 'true' : 'false' }}
                        :followers ={{ $category->total_followers }}
                        :user = {{ Auth::check() ? 'true' : 'false' }}
                        ></follow>
                    </div>

                </div>
            </div>

            @endforeach
            
        </div>

    </div>

@endsection