@extends('main')

@section('title' ,'try')

@section('content')
	
	<button class="ui primary button" onclick="confirm('Are you')">Click</button>

	<div class="uk-container">
		
		<div class="ui basic modal">
		  <div class="ui icon header">
		    <span uk-icon="icon:trash;ratio:2"></span>
		    <h3 class="uk-heading-primary">Archive Old Messages</h3>
		  </div>
		  <div class="content">
		    <p>Your inbox is getting full, would you like us to enable automatic archiving of old messages?</p>
		  </div>
		  <div class="actions">
		    <div class="ui red basic cancel inverted button">
		      <i class="remove icon"></i>
		      No
		    </div>
		    <div class="ui green ok inverted button">
		      <i class="checkmark icon"></i>
		      Yes
		    </div>
		  </div>
		</div>

	</div>

@endsection

@section('scripts')
	
	<script type="text/javascript">
		function confirm(){

		$('.ui.basic.modal')
			  .modal('show');
		}
	</script>

@endsection