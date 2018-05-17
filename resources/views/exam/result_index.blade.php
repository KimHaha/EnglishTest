@extends ('layouts.layout')

@section ('content')
<div id="page-content">
	<div class="container mrg">
            <link rel="stylesheet" type="text/css" href="css/bootstrap-multiselect.css" /><script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
            <script type="text/javascript">
			    $(document).ready(function(){
			    $('#post_req').validationEngine();
			    $('.multiselect1').multiselect();
			});
			</script>
	<div class="row">	
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
				    <div class="widget">
				    <h4 class="widget-title"> <span>Đợt thi</span></h4>
				    </div>
				</div>
			<form action="{{ route('result_search')}}" class="form-horizontal" id="ResultIndexForm" method="post" accept-charset="utf-8">
			{{ csrf_field() }}
				<div class="panel-body">
					<div class="form-group">
					<label for="subject_name" class="col-sm-3 control-label"><small>Examination Name</small></label>
					<div class="col-sm-6">
						<select name="examination_id" class="input-sm" id="ResultId">
						<option value="0">All Examination</option>
						@foreach ($examination_list as $examination)
						<option value="{{ $examination->id }}">{{ $examination->name }}</option>
						@endforeach
						</select>
					</div>
					</div>	
					<div class="form-group">
					<label for="subject_name" class="col-sm-3 control-label"><small>Result</small></label>
					<div class="col-sm-6">
						<select name="result" class="input-sm" id="ResultId">
						<option value="all">All</option>
						<option value="pass">Pass</option>
						<option value="fail">Fail</option>
						</select>
					</div>
					</div>	
				</div>	
			</div>
			
			<?php $user = Auth::user(); ?>
			@if (!$user->hasRole('student'))
			<div class="panel panel-default">
				<div class="panel-heading">
				    <div class="widget">
				    <h4 class="widget-title"> <span>Find Student</span></h4>
				    </div>
				</div>
				<div class="panel-body">
					<div class="row">
					<div class="form-group">
					<label for="subject_name" class="col-sm-3 control-label"><small>Name Or Email</small></label>
						<div class="col-sm-3">
						<input name="name_or_email" class="form-control input-sm]" placeholder="Name or Enrolment Number" type="text" id="ResultName"/>				
						</div>
					</div>
					</div>
					<div class="row">
					<div class="form-group">
					<label for="subject_name" class="col-sm-3 control-label"><small>Class</small></label>
					<div class="col-sm-3">
						<select name="class_id_list[]" multiple="multiple" class="form-control multiselect1" placeholder="Class" id="StudentGroupGroupName">
						@foreach ($class_list as $class)
						<option value="{{ $class->id }}">{{ $class->name }}</option>
						@endforeach
						</select>						
					</div>
					</div>
					</div>
				</div>			
			</div>
			@endif

			<div class="form-group text-left">
				<div class="col-sm-offset-3 col-sm-10">
					<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Search</button>
				</div>
			</div>
			</form>


		</div>
	</div>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">    
  </div>
</div>		
</div>
	</div>
@stop