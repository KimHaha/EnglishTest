@extends ('layouts.layout')

@section ('content')

<?php
    $list_column = \DB::getSchemaBuilder()->getColumnListing($table);
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
            $list_action = ['edit'];
            $title = 'User';
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
            <a href="{{ route($current_menu_item . '.create') }}" name="add" id="add" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Create {{ $title }}</a>

            <a href="Questions" class="btn btn-info"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;List Questions</a>        </div>
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
            <table class="table table-striped table-bordered">
                <tr>
                    <th><input type="checkbox" name="selectAll"  value="deleteall" id="selectAll"/></th>
                    @foreach ($list_column as $column)
                    <?php $column_title = ucwords(str_replace('_', ' ', $column)); ?>
                    <th>{{ $column_title }}</th>
                    @endforeach
                    @if ($current_menu_item == 'questions') 
                    <th>Category</th>
                    @endif
                    <th>Action</th>
                </tr>
                
                @foreach ($list_item as $item)
                <tr>
                    <td><input type="hidden" name="" id="DeleteCheckbox6_" value="0"/>
                        <input type="checkbox" name=""  value="6" id="DeleteCheckbox6" class="chkselect"/></td>

                    @foreach ($list_column as $column)
                    <td>

                        @if ($column == 'created_by') {{ $item->owner->name }}
                        @elseif ($column == 'updated_by') {{ $item->updater->name }}
                        @else {{ $item->$column }}
                        @endif
                    </td>


                    @endforeach

                    @if ($current_menu_item == 'questions') 
                    <td>
                        @foreach ($item->categories as $category) 
                            {{ $category->name }}
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


                        @if (in_array('delete', $list_action))                

                        <a href="{{ route($current_menu_item . '.destroy', $item->id) }}"
                            onclick="event.preventDefault();
                                     document.getElementById('delete-{{ $item->id }}').submit();" class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>

                            <form id="delete-{{ $item->id }}" action="{{ route($current_menu_item . '.destroy', $item->id) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
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