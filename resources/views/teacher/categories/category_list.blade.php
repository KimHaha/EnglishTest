@extends ('layouts.layout')

@section ('content')

        		<div id="page-content">
	<div class="container mrg">
                    <div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <a href="#" name="add" id="add" onclick="check_perform_add('Subjects/add');" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm lĩnh vực</a>            <a href="#" name="editallfrm" id="editallfrm" onclick="check_perform_edit('Subjects');" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>&nbsp;Sửa</a>            <a href="#" name="deleteallfrm" id="deleteallfrm" onclick="check_perform_delete();" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Xóa</a>            <a href="Questions" class="btn btn-success"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Xem câu hỏi</a>        </div>
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
<div class="col-md-10">
    <div class="row">
        <div class="col-md-7 text-right">
            <ul class="pagination pagination-sm">
                <li class="disabled"><a>&larr; Previous</a></li><li class="disabled"><a>&rarr; Next</a></li>                </ul>
            </div>
            <div class="col-md-3 text-left pad">
                <small>Showing 1 to 1 of 1 entries</small>
            </div>
                        <div class="col-md-2">
                <form action="subjects" id="SubjectIndexForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>                <div class="input-group">
                <input name="data[Subject][keyword]" class="form-control input-sm validate[required]" placeholder="Search" empty="1" type="text" id="SubjectKeyword"/>                <span class="input-group-btn "><button class="btn btn-success btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button></span>
                </div>
                </form>            </div>
                </div>
</div>        








<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span>Lĩnh vực</span></h4>
			</div>
		</div>


        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                    <th><input type="checkbox" name="selectAll"  value="deleteall" id="selectAll"/></td>
                    <th><a href="Subjects/index/sort:id/direction:desc">ID.</a></td>
                    <th><a href="Subjects/index/sort:subject_name/direction:desc" class="asc">Name</a></td>
                    <th>Display Name</td>
                    <th>Description</td>
                </tr>
                
                @foreach ($list_category as $category)
                <tr>
                    <td><input type="hidden" name="" id="DeleteCheckbox6_" value="0"/>
                        <input type="checkbox" name=""  value="6" id="DeleteCheckbox6" class="chkselect"/></td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td><a href="Questions/add" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Thêm câu hỏi</a></td>
                    <td><a href="#" name="editallfrm" onclick="check_perform_sedit('Subjects','6');" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>&nbsp;Sửa</a>                            <a href="#" onclick="check_perform_sdelete('6');" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;Xóa</a></td>
                
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
</div>		</div>
	</div>
	    </div>
@stop	    