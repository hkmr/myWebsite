@extends('main')

@section('title', 'Search Result')

@section('description' , 'tweblog ,best blogging sites ')

@section('content')


<div class="uk-padding-large">
	
	<div uk-grid>
		<div class="uk-width-1-5@m"></div>
		<div class="uk-width-3-5@m">
			<h1 class="uk-text-lead"><a href="#modal-full" class="link" uk-toggle><span uk-icon="icon:search; ratio:1.5"></span> </a> Search result for "{{ $keyword }}" </h1>
			<hr>

			<div class="infinite-scroll"> 
			<dl class="uk-description-list uk-description-list-divider">
			    

			@forelse($results as $result)

				<dt><h2 class="uk-text-lead">
					<a class="uk-link-reset" href="{{ route('blog.single', $result->slug) }}" title="{{ $result->title }}">
					 {{ substr(strip_tags($result->title), 0 ,60) }} {{ strlen( strip_tags($result->title )) >30 ? '...' : '' }}
					 </a>
					</h2>
				</dt>
			    <dd> 
			    	<p class="uk-text-muted">
			    		{{ substr(strip_tags($result->body), 0 ,100) }} {{ strlen(strip_tags($result->body)) >250 ? '...' : '' }}<a href="{{ route('blog.single', $result->slug) }}">read more.</a>
			    	</p>
			     </dd>

			@empty

				<p>No result found...</p>
			@endforelse
			
			<p>{{ $results->links() }}</p>


			</dl>
			</div>

		</div>
	</div>

</div>

@endsection