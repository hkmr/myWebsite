@extends('main')

@section('title' , "Categories Followed")

@section('description',' blogs category')

@section('content')

	<div class="uk-container uk-margin-xlarge-top">
		
		<div class="uk-child-width-1-4@m uk-text-center" uk-grid>

	        @foreach( $categories as $category )
	        <div class="uk-padding-small">
	            <div class="uk-inline uk-light uk-margin uk-inline-clip uk-transition-toggle">

	                <img class="uk-transition-scale-up uk-transition-opaque" src="/images/categories/gaming.jpeg" alt="">
	                <div class="uk-overlay-primary uk-position-cover"></div>
	                <div class="uk-position-center">
	                    <a class="uk-link-reset" href="{{'/categories/'.$category->id }}">
	                        <span class="uk-text-large uk-text-bold uk-text-uppercase"> {{ $category->name }} </span>
	                    </a><br>
	                    <small class="uk-text-meta">{{$category->total_posts}} Stories</small>
	                    <follow
	                    :category ={{ $category->id }}
	                    :followed = {{ $category->followed() ? 'true' : 'false' }}
	                    :followers ={{ $category->total_followers }}
	                    ></follow>
	                </div>

	            </div>
	        </div>

	        @endforeach
	        
	    </div>

	</div>

@endsection