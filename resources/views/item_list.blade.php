@extends ('layouts.layout')

@section ('content')

<?php
    $list_column = \DB::getSchemaBuilder()->getColumnListing($table);
    if ($current_menu_item == 'users')
    {
        $list_column = array_diff($list_column, ['password', 'remember_token']);
    }
    $list_column = array_diff($list_column, ['created_at', 'created_by']);
    switch ($current_menu_item) {
        case 'categories':
            $title = 'Category';
            $list_action = ['create', 'edit', 'delete'];
            break;
        
        case 'questions': 
            $title = 'Question';
            $list_action = ['create', 'edit', 'delete'];
            break;

        case 'roles':
            $title = 'Role';
            $list_action = ['create', 'edit', 'delete'];
            break;

        case 'permissions':
            $title = 'Permission';
            $list_action = ['create', 'edit', 'delete'];
            break;

        case 'users':
            if (isset($action)) 
                $list_action = ['add user', 'delete'];
            else 
                $list_action = ['edit'];
            $title = 'User';
            array_push($list_column, 'role');
            break;

        case 'classes':
            $list_action = ['create', 'edit', 'delete'];
            $title = 'Class';
            break;

        case 'exams':
            $list_action = ['delete', 'view'];
            $title = 'Exam';
            break;
            
        case 'examinations':
            $list_action = ['create', 'edit', 'delete', 'show exam', 'create exam'];
            $title = 'Examination';
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
    <div class="col-md-12">
        <div class="btn-group">
            @if (in_array('add user', $list_action))
            <a href="{{ route('classes.users.add', $class_id) }}" name="add" id="add" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add {{ $title }}</a>
            @elseif ($current_menu_item != 'exams')
            <a href="{{ route($current_menu_item . '.create') }}" name="add" id="add" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Create {{ $title }}</a>
            @endif

            @if ($current_menu_item == 'categories')
            <a href="questions" class="btn btn-info"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List Questions</a>        </div>
            @endif
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
				<h4 class="widget-title"> <span>{{ $title }}</span></h4>
			</div>
		</div>


        <div class="table-responsive">
            <table class="table table-striped table-bordered  ">

                {{-- header of table --}}
                <tr>
                    <th><input type="checkbox" name="selectAll"  value="deleteall" id="selectAll"/></th>

                    @foreach ($list_column as $column)

                    <?php 
                    	if ($column == 'examination_id') 
                    		$column_title = 'Examination';
                        elseif ($column == 'class_id') 
                            $column_title = 'Class';
                        elseif ($column == 'teacher_id')
                            $column_title = 'Teacher';
                        elseif ($column == 'role')
                            $column_title = 'Role';
                        else
                            $column_title = ucwords(str_replace('_', ' ', $column)); 
                        ?>
                    <th>{{ $column_title }}</th>
                    @endforeach


                    @if ($current_menu_item == 'questions') 
                    <th>Category</th>
                    @elseif ($current_menu_item == 'examinations')
                    <th>Class Join</th>
                    @endif

                    <th>Action</th>
                </tr>
                
                {{-- content --}}
                @foreach ($list_item as $item)
                <tr>
                    <td><input type="hidden" name="" id="DeleteCheckbox6_" value="0"/>
                        <input type="checkbox" name=""  value="6" id="DeleteCheckbox6" class="chkselect"/></td>

                    @foreach ($list_column as $column)
                    <td>
                        @if ($column == 'examination_id')
                            {{ $item->examination->name }}
                        @elseif ($column == 'teacher_id')
                            @if ($item->teacher != NULL)
                            {{ $item->teacher->name }}
                            @endif
                        @elseif ($column == 'role')
                            @foreach ($item->roles as $role)
                                {{ $role->display_name }}
                            @endforeach
                        @elseif ($column == 'class_id')
                            @if ($item->class != NULL)
                            {{ $item->class->name }}
                            @endif
                        @elseif ($column == 'created_by') 
                            @if ($item->owner) {{ $item->owner->name }}
                            @else NULL
                            @endif
                        @elseif ($column == 'updated_by') 
                            @if ($item->updater) {{ $item->updater->name }}
                            @else NULL
                            @endif
                        @elseif ($column == 'name' && $current_menu_item == 'classes')
                        <a href="{{ route('classes.show', $item->id) }}">{{ $item->$column }}</a>
                        @else {{ $out = strlen($item->$column) > 10 ? substr($item->$column,0,10)."..." : $item->$column }}
                        @endif
                        
                    </td>


                    @endforeach

                    @if ($current_menu_item == 'questions') 
                    <td>
                        @foreach ($item->categories as $category) 
                            {{ $category->name }}
                        @endforeach
                    </td>
                    @elseif ($current_menu_item == 'examinations')
                    <td>
                        @foreach ($item->classes as $class) 
                            {{ $class->name }},
                        @endforeach
                    </td>
                    @endif

          {{--           @if ($current_menu_item == 'categories')
                    <td><a href="Questions/add" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm câu hỏi</a></td>
                    @endif  --}}

                    {{-- action --}}
                    <td>
                        @if (in_array('edit', $list_action))
                        <a href="{{ route($current_menu_item . '.edit', $item->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit</a>
                        @endif

                        @if (in_array('view', $list_action))
                        <a href="{{ route($current_menu_item . '.show', $item->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span>&nbsp;View Exam</a>
                        @endif


                        @if (in_array('delete', $list_action))                
                        @if (isset($action) && $current_menu_item == 'users')
                        <a href="{{ route('classes.users.destroy', [$class_id, $item->id]) }}"
                            class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
                        @else 
                        <a href="{{ route($current_menu_item . '.destroy', $item->id) }}"
                            onclick="event.preventDefault();
                                     document.getElementById('delete-{{ $item->id }}').submit();" class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>

                            <form id="delete-{{ $item->id }}" action="{{ route($current_menu_item . '.destroy', $item->id) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        @endif
                        @endif

                        @if (in_array('create exam', $list_action))
                        <a href="{{ route('generate_list_exam', $item->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span>&nbsp;Create Exam</a>
                        @endif
                        @if (in_array('show exam', $list_action))
                        <a href="{{ route('examinations.show', $item->id) }}" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span>&nbsp;Show Exam</a>
                        @endif
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