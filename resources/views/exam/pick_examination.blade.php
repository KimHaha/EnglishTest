@extends ('layouts.layout')

@section ('content')

<?php
    $list_column = \DB::getSchemaBuilder()->getColumnListing($table);
    switch ($current_menu_item) {

        case 'exams':
            $title = 'Exam';
            break;

        default:
            # code...
            $title = '';
            break;
    }

?>



<div id="page-content">
	<div class="container mrg">
        <div class="row">

        <div class="col-md-2 mrg-1">
    <form action="subjects" id="SubjectIndexForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>    <label><small>Show&nbsp;</small>
    <select name="data[Subject][limit]" default="20" onChange="this.form.submit();" class="input-sm" id="SubjectLimit">
<option value="5">5</option>
<option value="10">10</option>
<option value="20" selected="selected">20</option>
<option value="25">25</option>
<option value="30">30</option>
<option value="50">50</option>
<option value="100">100</option>
<option value="200">200</option>
<option value="500">500</option>
</select>    <small>&nbsp;entries</small></label>
    <input type="hidden" name="data[Subject][keyword]" class="form-control input-sm" placeholder="Search" empty="1" id="SubjectKeyword"/></form></div>






<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span>Chose An Examination</span></h4>
			</div>
		</div>


        <div class="table-responsive col-md-offset-2">
            <h4> <span>List Examination</span></h4>
            @if ($examination_list != null)
            @foreach ($examination_list as $examination)
            <label><a href="{{ route('do_examination', $examination->id) }}">{{ $examination->name }}</a></label>
            @endforeach
            @endif
        </div>
        </div>
    </div>
</div>


<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>		


</div>
	</div>
	    </div>
@stop	    