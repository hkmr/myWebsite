@extends('main')

@section('title', '| Edit Post')

@section('description', 'Edit Story')

@section('content')

    <div class="uk-padding-large uk-margin-large-top">
    	
    	<div uk-grid>
    		<div class="uk-width-1-6@m"></div>

    		<div class="uk-width-3-5">
    			
    			<h1 class="uk-heading-primary">Edit Story</h1>

    			Created at : {{ date('j M, Y',strtotime($post->created_at) ) }}
    			Updated at : {{ date('j M, Y',strtotime($post->updated_at) ) }}

    			{!! Form::model($post , ['route' => ['posts.update', $post->id] ,'method' => 'PUT' ,'files' => true ]) !!}

    			<div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
		            <label><input class="uk-radio" type="radio" name="status" value="1" checked> Public</label>
		            <label><input class="uk-radio" type="radio" name="status" value="0" > Private</label>
		        </div>

				<div class="uk-margin">
					{{ Form::text('title',null, ['class'=> 'uk-input', 'required' =>'required', 'maxlength'=>'255', 'placeholder' => 'Title of Story'] ) }}
				</div>

				<div class="uk-margin">
					{{ Form::select('category_id', $categories, null, ['class' => 'uk-select ']) }}
				</div>

				<div class="uk-margin">
					<div uk-form-custom>
						{{ Form::file('featured_image') }}
						<button class="uk-button uk-button-default" type="button" tabindex="-1">Select Cover Image</button>
					</div>
				</div>

				<div class="uk-margin uk-margin-xlarge-top">
					{{ Form::textarea('body', null, ['class'=> 'uk-textarea', 'required' =>'required', 'id' => 'post-body'] ) }}
				</div>

				<div class="uk-margin">
					{!! Html::linkRoute('posts.show', 'CANCEL' , array($post->id), array('class' => 'uk-button uk-button-danger') ) !!}

					{{ Form::submit('SAVE', ['class' => 'uk-button uk-button-primary']) }}
				</div>


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
        menubar: view,
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern textcolor"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | fontselect | forecolor | fontsizeselect | fullscreen",
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
