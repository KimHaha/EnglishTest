@extends ('layouts.layout')

@section ('content')

<?php

	// get all column
    $list_column = \DB::getSchemaBuilder()->getColumnListing($table);

	switch ($current_menu_item) {

        case 'questions': 
            $title = 'Question';
            $list_action = ['create', 'edit', 'delete'];
            break;
    }

    if ($action == 'create') {
    	$action_title = 'Add';
    	$form_url = $current_menu_item . '.store';
    }
    else if ($action == 'edit') {
    	$action_title = 'Edit';
    	$form_url = $current_menu_item . '.update';
    }
?>

<div class="panel panel-default mrg">

    <div class="panel-heading"><div class="widget-modal"><h4 class="widget-modal-title">{{ $action_title }} <span>{{ $title }}</span> </h4></div></div>


    <div class="panel-body">
        <form action="{{ route($form_url, $edited_question->id) }}" method="post">

        	{{ csrf_field() }}

        	{{ method_field('PUT') }}
      
            <div class="col-md-12">
                    <div class="form-group">
                        <label for="type"><small>Type <span class="text-danger"> *</span></small></label>
                        <select name="type" class="form-control" placeholder="Type" id="question_type">
                            @foreach ($list_data->type as $option)

                            @if ($option == $edited_question->type)
                            <option value="{{ $option }}" selected="">{{ $option }}</option>
                            @else
                            <option value="{{ $option }}">{{ $option }}</option>
                            @endif

                            @endforeach
                        </select>  
                    </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">

                    <label for="weight"><small>Weight<span class="text-danger"> *</span></small></label>

                    <input name="weight" class="form-control input-sm" placeholder="Weight" if maxlength="100" value="{{ $edited_question->weight }}">
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">

                    <label for="difficult"><small>Difficult<span class="text-danger"> *</span></small></label>

                    <input name="difficult" class="form-control input-sm" placeholder="Difficult" if maxlength="100" value="{{ $edited_question->difficult }}">
                </div>
                </div>


                <?php 
                    $category_id_list = [];
                    foreach ($edited_question->categories as $category) {
                        array_push($category_id_list, $category->id);
                    }
                ?>
                <div class="col-md-6">
                <div class="form-group">

                    <label for="difficult"><small>Category<span class="text-danger"> *</span></small></label>

                    
                    <div class="form-check">
                    @foreach ($list_data->category as $category)
                        @if (in_array($category->id, $category_id_list))
                        <input name="category_id[]" class="form-check-input" type="checkbox" value="{{ $category->id }}" checked>
                        @else
                        <input name="category_id[]" class="form-check-input" type="checkbox" value="{{ $category->id }}">
                        @endif
                      <label class="form-check-label">{{ $category->name }}</label>
                    @endforeach
                    </div>
                </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="skill"><small>Skill</small></label>
                        <div>
                        @foreach ($list_data->skill as $option)
                        @if ($option == $edited_question->skill)
                        <label class="radio-inline"><input type="radio" name="skill" value="{{ $option }}" checked="checked">{{ $option }}</label>
                        @else
                        <label class="radio-inline"><input type="radio" name="skill" value="{{ $option }}">{{ $option }}</label>
                        @endif
                        @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="question"><small>Question <span class="text-danger"> *</span></small></label>

                        <div>
                           <textarea name="question" class="form-control" placeholder="Exam Instruction" cols="30" rows="6">{{ $edited_question->question }}</textarea><br>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" id="choice_field" style="display: none">
                    <div class="form-group">
                        <label for="choice"><small>Choice<span class="text-danger"> *</span></small></label>

                        <input name="choice" class="form-control input-sm" placeholder="Choice" if maxlength="100" value="{{ $edited_question->choice }}">
                    </div>
                </div>  


                <div class="col-md-12" id="solution">
                    <div class="form-group">
                        <label for="solution"><small>Solution<span class="text-danger"> *</span></small></label>

                        <div>
                           <textarea name="solution" class="form-control" placeholder="Exam Instruction" cols="30" rows="6">{{ $edited_question->solution }}</textarea><br>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" id="true_false_solution">
                    <div class="form-group">
                        <label for="true_false_solution"><small>Solution<span class="text-danger"> *</span></small></label>

                        <div>
                            @if ($edited_question->solution == "true")
                            <input type="radio" name="true_false_solution" value="true" checked="checked">True
                            <input type="radio" name="true_false_solution" value="false">False
                            @else
                            <input type="radio" name="true_false_solution" value="true" >True
                            <input type="radio" name="true_false_solution" value="false" checked="checked">False
                            @endif
                        </div>
                    </div>
                </div>  


			{{-- submit or cancel --}}
	        <div class="form-group text-left">
	            <div class="col-sm-offset-3 col-sm-10">
	                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Save</button>
	                <a href="{{ route($current_menu_item . '.index') }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
	            </div>
	        </div>
	    </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        if ($("#question_type").val() == "many_choice") 
            $("#choice_field").slideDown();
        else 
            $("#choice_field").slideUp();

        if ($("#question_type").val() == "true_false") {
            $("#true_false_solution").slideDown();
            $("#solution").slideUp();
        }
        else {
            $("#true_false_solution").slideUp();
            $("#solution").slideDown();
        }

        $("#question_type").change(function () {
            if ($(this).val() == "many_choice")
                $("#choice_field").slideDown();
            else
                $("#choice_field").slideUp();

            if ($(this).val() == "true_false") {
                $("#true_false_solution").slideDown();
                $("#solution").slideUp();
            }
            else {
                $("#true_false_solution").slideUp();
                $("#solution").slideDown();
            }
        });

    });
</script>

			
@stop