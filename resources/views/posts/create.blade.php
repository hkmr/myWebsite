@extends('main')

@section('title','Create New Stories')

@section('description', 'create new post in tweBox')

@section('stylesheets')

	<!-- include libraries(jQuery, bootstrap) -->
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">

@endsection

@section('content')
	

 	<div class="uk-padding-large uk-margin-large-top">
 		
 		<div uk-grid>
 			<div class="uk-width-1-6@m"></div>
 			<div class="uk-width-3-5@m">
 				<h1 class="uk-heading-divider">Write Story</h1>
 				{!! Form::open(array('route' => 'posts.store' , 'data-parsley-validate' => '', 'files' => true)) !!}

			        <fieldset class="uk-fieldset">
			        	
			        	<div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
			        		<div class="uk-form-label uk-text-large">Make story as:</div>
				            <label><input class="uk-radio" type="radio" name="status" value="1" checked> Public</label>
				            <label><input class="uk-radio" type="radio" name="status" value="0" > Private</label>
				        </div>

	 					<div class="uk-margin">

					        {{ Form::text('title', null, ['class' => 'uk-input uk-form-width-1-1', 'required' =>'', 'maxlength' =>'255', 'placeholder' => 'Title Of Story']) }}
					    </div>

					    <div class="uk-margin">
					        
					        {{ Form::label('category_id', 'Select Category') }}

					        <div class="uk-form-controls">
					            <select class="uk-select" name="category_id" >
					        
					        @foreach( $categories as $category )
					                <option value="{{$category->id}}">{{$category->name}}</option>
					        @endforeach
					            </select>
					        </div>
					    </div>

					    <div class="uk-margin" uk-margin>
					        <div uk-form-custom="target: true">
					        	
					        	{{ Form::label('featured_image', 'Select Cover Image' ) }}
					        
					            {{ Form::file('featured_image') }}
					            <input class="uk-input uk-form-width-medium" type="text" placeholder="Select Cover Image" disabled>

					        </div>
					    </div>

					     <div class="uk-margin">

					     	{{ Form::textarea('body', null, ['class'=> 'uk-textarea', 'id'=>'post-body']) }}

				        </div>

			        </fieldset>	

			        {{ Form::submit('Publish' , ['class' => 'uk-button uk-button-primary']) }}

 				{!! Form::close() !!}
 			</div>
 		</div>

 	</div>
	 
@endsection


@section('scripts')

<script src='/js/tinymce/tinymce.min.js'></script>

<script>
    var editor_config = {
        path_absolute : "{{ URL::to('/') }}/",
        selector: "textarea",
        menubar: false,
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern textcolor"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | fontselect | forecolor | fontsizeselect",
        content_css: [
'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
'//www.tinymce.com/css/codepen.min.css'],
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }
            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };
    tinymce.init(editor_config);
</script>


@endsection