@extends ('layouts.layout')

@section ('content')

<?php
    $user = Auth::user();
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

    if ($action == 'show') {
        $style = 'show_result';
    } elseif ($action == 'doing_exam') {
        $style = 'no_result';
    } elseif ($action == 'view_result') {
        $style = 'view_result';
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
				<h4 class="widget-title"> <span>{{ $title }} @if ($action == 'view_result') OF {{ $exam->user->name }}  @endif</span></h4>
                @if ($action == 'doing_exam') 
                <div>Remaining Time <span id="time"></span> minutes!</div>
                @elseif ($action == 'view_result')
                <div>Score: {{ $exam->score }}</div>
                @endif
			</div>
		</div>


        <div class="table-responsive">
            <form action="{{ route('calculate_score', $exam->id) }}" method="post" id="form_test">
                {{ csrf_field() }}
            <?php 
                $index = 1; 
                $choice_label = ['A', 'B', 'C', 'D', 'E', 'F'];
            ?>
            @foreach ($question_list as $question)
            <div class="form-group col-md-offset-2">
                <label for="{{ $question->id }}">{{ $index }}. {{ $question->question }}</label>
                <?php 
                    $choices = explode(',', $question->choice); 
                    shuffle($choices);
                    $index++;
                    $index_label = 0;
                ?>
                @foreach ($choices as $choice)
                <div>
                    <label class="radio-inline 
                    @if ($action != 'doing_exam' && $choice == $question->solution) bg-success @elseif (isset($content_list) && $choice == $content_list[$index-2]) bg-danger @endif">
                    <input type="radio" name="{{ $question->id }}" value="{{ $choice }}"

                    @if ($action != 'doing_exam')
                        disabled="" 
                    @endif

                    @if ($action == 'view_result')
                        @if (isset($content_list) && $choice == $content_list[$index-2])
                            checked=""
                        @endif 
                    @endif
                    >{{ $choice_label[$index_label] }}. {{ $choice }}</label>
                </div>
                <?php $index_label ++; ?>
                @endforeach
            </div>
            @endforeach

            @if ($action == 'doing_exam')
            <div class="form-group text-left">
                <div class="col-sm-offset-3 col-sm-10">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Submit</button>
                </div>
            </div>
            @endif
            </form>
        </div>
        </div>
    </div>
</div>

@if ($action == 'doing_exam')
<script type="text/javascript">
function startTimer(duration, display) {
    var start = Date.now(),
        diff,
        minutes,
        seconds;
    function timer() {
        // get the number of seconds that have elapsed since 
        // startTimer() was called
        diff = duration - (((Date.now() - start) / 1000) | 0);

        // does the same job as parseInt truncates the float
        minutes = (diff / 60) | 0;
        seconds = (diff % 60) | 0;

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds; 

        if (diff <= 0) {
            // add one second so that the count down starts at the full duration
            // example 05:00 not 04:59
            alert('Time over!');
            clearInterval(clock_interval);
            $("#form_test").submit();
        }
    };
    // we don't want to wait a full second before the timer starts
    timer();
    clock_interval = setInterval(timer, 1000);
}

window.onload = function () {
    var time = 10,
        display = document.querySelector('#time');
    startTimer(time, display);
};
</script>
@endif

<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>		


</div>
	</div>
	    </div>
@stop	    