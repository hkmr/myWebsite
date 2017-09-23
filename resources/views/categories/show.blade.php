@extends('main')

@section('title' , " Blogs ")

@section('description',' blogs category')

@section('content')

{{-- 	<section id="blog" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-7">
                    <div class="row">

                        @if($posts->count() == 0 )

                        <div class="col-sm-12 col-md-12">
                            <div class="single-blog single-column">
                                <h1>Sorry ! No posts yet.. </h1>
                                <h2>Stay tuned !</h2>                                        
                            </div>
                        </div>

                        @else
                    	@foreach ($posts as $post)
                         <div class="col-sm-12 col-md-12">
                            <div class="single-blog single-column">
                                <div class="post-thumb">
                                    <a href="{{ route('blog.single', $post->slug) }}">
                                    @if($post->image == null)
									<img src=" {{ asset('images/blog/blog-default.jpg') }} " alt="default-image" height="270" width="480" />
									@else
										<img src=" {{ asset('images/blog/'. $post->image) }} " alt="{{$post->name}}" height="270" width="480" />
									@endif
                                    </a>
                                    <div class="post-overlay">
                                       <span class="uppercase"><a href="#">14 <br><small>Feb</small></a></span>
                                   </div>
                                </div>
                                <div class="post-content overflow">
                                    <h2 class="post-title bold"><a href="{{ route('blog.single', $post->slug) }}">{{ $post->title }}</a></h2>
                                    <h3 class="post-author"><a href="{{ '/profile/'. $post->user_id }}">Posted by {{ $users->where('id',$post->user_id)->pluck('name')->first() }}</a></h3>
                                    <p>{{ substr(strip_tags($post->body), 0, 250) }} {{ strlen(strip_tags($post->body)) >250 ? '...' : '' }}</p>
                                    <a href="{{ route('blog.single', $post->slug) }}" class="read-more">View More</a>
                                    <div class="post-bottom overflow">
                                        <ul class="nav navbar-nav post-nav">
                                            <li><a href="{{'/categories/'.$post->category->id }}"><i class="fa fa-tag"></i>{{ $post->category->name }}</a></li>
                                            <li><a href="{{ route('blog.single', $post->slug) }}"><i class="fa fa-heart"></i>{{ $post->views }} Views</a></li>
                                            <li><a href="{{ route('blog.single', $post->slug.'#comments') }}"><i class="fa fa-comments"></i>{{$post->comments->count() }} Comments</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        
                        @endif

                    </div>
                    <div class="blog-pagination">
                        <ul class="pagination">
                          {!! $posts->links(); !!}
                        </ul>
                    </div>
                 </div>
            </div>
        </div>
    </section>
	 --}}

     <div class="uk-padding-large">
         <h1 class="uk-heading-primary">All stories related to same category...</h1>

         {{$category}}
     </div>

@endsection