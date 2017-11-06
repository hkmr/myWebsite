@extends('main')

@section('title', $user->name.'\'s Profile')


@section('content')

	<div class="uk-container uk-margin-xlarge-top">
		<div uk-grid>
			<div class="uk-width-1-5@m"></div>
			<div class="uk-width-3-5@m">
				
				{!! Form::model($user , ['route' => ['profile.update', $user->username] , 'method' =>'PUT' , 'files' => 'true'] ) !!}

				<fieldset class="uk-fieldset">
					
					<legend class="uk-legend">Update Profile</legend>

					<div class="uk-margin">
						{{ Form::label('name' , 'UserName', ['class' => 'uk-form-label']) }}
						<div class="uk-form-control">
							{{ Form::text('name', null , ['class' => 'uk-input', 'readonly']) }}
						</div>
					</div>

					<div class="uk-margin">
						{{ Form::label('email', 'Email', [ 'class' => 'uk-form-label']) }}
						<div class="uk-form-control">
							{{ Form::text('email', null , ['class'=> 'uk-input', 'readonly']) }}
						</div>
					</div>

					<div class="uk-margin">
						{{ Form::label('avatar', 'Change Profle Image', [ 'class' => 'uk-form-label']) }}
						<div class="uk-form-control">
							<div uk-form-custom>
							{{ Form::file('avatar') }}
							<button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
							</div>
						</div>
					</div>

					<div class="uk-margin">
						{{ Form::label('coverImage', 'Change Cover Image', [ 'class' => 'uk-form-label']) }}
						<div class="uk-form-control">
							<div uk-form-custom>
							{{ Form::file('coverImage') }}
							<button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
							</div>
						</div>
					</div>

					<div class="uk-text-lead">Social Connect : </div>

					<div class="uk-margin">
						{{ Form::label('facebook', 'Facebook link:' ,['class'=> 'uk-form-label']) }}
						<div class="uk-form-control">
							{{ Form::text('facebook', null, ['class'=> 'uk-input', 'placeholder' => 'https://facebook.com/user_name' ]) }}
						</div>
					</div>

					<div class="uk-margin">
						{{ Form::label('twitter', 'Twitter link:' ,['class'=> 'uk-form-label']) }}
						<div class="uk-form-control">
							{{ Form::text('twitter', null, ['class'=> 'uk-input', 'placeholder' => 'https://twitter.com/user_name' ]) }}
						</div>
					</div>

					<div class="uk-margin">
						{{ Form::label('instagram', 'Instagram link:' ,['class'=> 'uk-form-label']) }}
						<div class="uk-form-control">
							{{ Form::text('instagram', null, ['class'=> 'uk-input', 'placeholder' => 'https://instagram.com/user_name' ]) }}
						</div>
					</div>

					<div class="uk-margin">
						{{ Form::label('tumblr', 'Tumblr link:' ,['class'=> 'uk-form-label']) }}
						<div class="uk-form-control">
							{{ Form::text('tumblr', null, ['class'=> 'uk-input', 'placeholder' => 'https://tumblr.com/user_name' ]) }}
						</div>
					</div>

					<div class="uk-margin">
						{{ Form::label('youtube', 'Youtube link:' ,['class'=> 'uk-form-label']) }}
						<div class="uk-form-control">
							{{ Form::text('youtube', null, ['class'=> 'uk-input', 'placeholder' => 'https://youtube.com/user_name' ]) }}
						</div>
					</div>

					<div class="uk-margin">
						{{ Form::label('info', 'About Yourself:',['class'=> 'uk-form-label' ]) }}
						<div class="uk-form-control">
							{!! Form::textarea('info', null, ['class' => 'uk-textarea ', 'required']) !!}
						</div>
					</div>

					<div class="uk-margin">
						{!! Html::linkRoute('profile.show', 'Cancel' , array($user->username), array('class' => 'uk-button uk-button-danger') ) !!} 

						{{ Form::submit('Save', ['class' => 'uk-button uk-button-primary']) }}
					</div>

				</fieldset>

				{!! Form::close() !!}

			</div>
		</div>
	</div>


@endsection
