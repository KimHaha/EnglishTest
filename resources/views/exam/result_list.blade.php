@extends ('layouts.layout')

@section ('content')
<div id="page-content">
	<div class="container mrg">
        <div class="row">
    <div class="col-md-12">
        <div class="btn-group">
    </div>

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
				<h4 class="widget-title"> <span>Tests</span></h4>
			</div>
		</div>


        <div class="table-responsive">
            <table class="table table-striped table-bordered  ">

                {{-- header of table --}}
                <?php $user = Auth::user(); ?>
                <tr>
                    <th><input type="checkbox" name="selectAll"  value="deleteall" id="selectAll"/></th>
                    <th>ID</th>
                    <th>Examination</th>
                    @if ($user->hasRole('teacher'))
                    <th>Class</th>
                    @endif
                    <th>Num Try</th>
                    <th>Score</th>
                    <th>Pass</th>
                    <th>Time Accomplished</th>
                    <th>Action</th>
            	</tr>


            	@foreach ($tests as $test)
            	<tr>
					<td>
					<input type="hidden" name="" id="DeleteCheckbox6_" value="0"/>
                        <input type="checkbox" name=""  value="6" id="DeleteCheckbox6" class="chkselect"/></td>

                    <td><a href="{{ route('show_result', $test->id) }}">{{ $test->id }}</a></td>
                    <td>{{ $test->exam->examination->name }}</td>
                    @if ($user->hasRole('teacher'))
                    <td>{{ $test->user->class->name }}</td>
                    @endif
                    <td>{{ $test->num_try }}</td>
                    <td>{{ $test->score }}</td>
                    @if ($test->pass)
                    <td>Pass</td>
                    @else 
                    <td>Fail</td>
                    @endif
                    <td>{{ $test->updated_at }}</td>
                    <td>
                        <a href="{{ route('show_result', $test->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span>&nbsp;View</a>
                    </td>
                </tr>
                @endforeach

            </table>
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