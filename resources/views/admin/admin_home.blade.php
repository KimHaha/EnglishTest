
    
@extends ('layouts.layout')

@section ('content')





<div id="page-content">
	<div class="container mrg">
        <div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">x</button>
		<center>Thank you for logging in!</center>
		</div>	
		<div class="row">	
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="widget">
						<h4 class="widget-title">Thống kê <span>đợt thi</span></h4>
						</div>
					</div>
					<table class="table">
						<tr>
							<td>Đang hoạt động</td>
							<td>__________</td>
							<td>{{ $active_count_examination }}</td>
						</tr>
						<tr>
							<td>Sắp tới</td>
							<td>__________</td>
							<td>{{ $upcoming_count_examination }}</td>
						</tr>
						<tr>
							<td>Hoàn thành</td>
							<td>__________</td>
							<td>{{ $finished_count_examination }}</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</div>
			</div>
			





			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="widget">
						<h4 class="widget-title">Đợt thi <span>Sắp đến</span></h4>
						</div>
					</div>					
					<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tr>
							<th>Start Time</th>
							<th>Examination</th>
							<th>Class Join</th>
							<th>Pass Score</th>
							<th>Time</th>
						</tr>

						@if ($upcoming_count_examination != 0)
						@foreach ($examination_upcoming_list as $examination)
						<tr>
							<td>{{ $examination->start_time }}</td>
							<td>{{ $examination->name }}</td>
							<td>
								@foreach ($examination->classes as $class) 
		                            {{ $class->name }},
		                        @endforeach
							</td>
							<td>{{ $examination->pass_score }}</td>
							<td>40 mins</td>
						</tr>
						@endforeach

						@else
						<tr><td colspan="5">&nbsp;</td></tr>
						<tr><td colspan="5">&nbsp;</td></tr>
						<tr><td colspan="5">&nbsp;</td></tr>
						@endif
					</table>
					</div>					
				</div> 
			</div>

			
			<form action="results" controller="Results" name="post_req" id="post_req" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="widget">
						<h4 class="widget-title">Kết quả thi <span>gần đây</span></h4>
						</div>
					</div>
					<div class="table-responsive">

					@if (isset($last_examination))
					<table class="table table-bordered">
						<tr>
							<th>Thi</th>
							<th>Kết quả tổng thể</th>
							<th>Thống kê sinh viên</th>
						</tr>
						<tr>
							<td><strong class="text-danger">{{ $last_examination->name }}</strong><br/>
							Từ: <strong class="text-danger">{{ $last_examination->start_time }}</strong><br/>
							Đến: <strong class="text-danger">{{ $last_examination->end_time }}</strong><br/>
							<a href="">Chi tiết</a></td>
							<td>
								<div class="chart">
								<div id="mywrapperor10"></div>
								<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
    // HIGHROLLER - HIGHCHARTS UTC OPTIONS 
    Highcharts.setOptions(
        {"global":{"useUTC":true}}
    );
    // HIGHROLLER - HIGHCHARTS '' bar chart

    var mywrapperor10 = new Highcharts.Chart(
        {"chart":{"renderTo":"mywrapperor10","type":"bar","width":350,"height":200},"title":{"text":null},"series":[{"name":"Passing %age","data":[50]},{"name":"Average %age","data":[45.45]}],"legend":{"enabled":true},"xAxis":{},"credits":{"enabled":false}}
    );
    
    //for column drilldown
    function setChart(name, categories, data, color) {
        mywrapperor10.xAxis[0].setCategories(categories);
        mywrapperor10.series[0].remove();
        mywrapperor10.addSeries({
            name: name,
            data: data,
            color: color || 'white'
        });
    }   
});
//]]>
</script>									</div>
								</td>
								<td>
									<div class="chart">
									<div id="mywrapperss10"></div>
									<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
    // HIGHROLLER - HIGHCHARTS UTC OPTIONS 
    Highcharts.setOptions(
        {"global":{"useUTC":true}}
    );
    // HIGHROLLER - HIGHCHARTS '' pie chart

    var mywrapperss10 = new Highcharts.Chart(
        {"chart":{"renderTo":"mywrapperss10","type":"pie","width":300,"height":200},"title":{"text":null},"series":[{"name":"Student","data":[["Pass",1],["Fail",2],["Absent",0]]}],"plotOptions":{"pie":{"dataLabels":{"style":{},"enabled":true,"format":"{point.name}:<b>{point.percentage:.1f}%<\/b>"},"formatter":{"formatter":""},"showInLegend":true}},"xAxis":{},"credits":{"enabled":false}}
    );
    
    //for column drilldown
    function setChart(name, categories, data, color) {
        mywrapperss10.xAxis[0].setCategories(categories);
        mywrapperss10.series[0].remove();
        mywrapperss10.addSeries({
            name: name,
            data: data,
            color: color || 'white'
        });
    }   
});
//]]>
</script>									</div>
								</td>
							</tr>
																			</table>
																			@endif
					</div>
				</div> 
			</div>
			<input type="hidden" name="id" value="" id="ResultsResult"/>			</form>			<div class="col-md-12"><div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="widget">
						<h4 class="widget-title">Biểu đồ <span>nhóm sinh viên</span></h4>
						</div>
					</div>
					<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tr>
							<td>
							<div class="chart">
							<div id="mywrapperd2"></div>
							<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
    // HIGHROLLER - HIGHCHARTS UTC OPTIONS 
    Highcharts.setOptions(
        {"global":{"useUTC":true}}
    );
    // HIGHROLLER - HIGHCHARTS 'User Details' column chart

    var mywrapperd2 = new Highcharts.Chart(
        {"chart":{"renderTo":"mywrapperd2","type":"column"},"title":{"text":"User Details"},"series":[{"name":"Active","data":[0,2,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0]},{"name":"Pending","data":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]},{"name":"Suspend","data":[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]}],"legend":{"enabled":true},"xAxis":{"categories":["L\u1edbp 3A","L\u1edbp 3B","L\u1edbp 3C","L\u1edbp 3D","L\u1edbp 3E","L\u1edbp 3G","L\u1edbp 4A","L\u1edbp 4B","L\u1edbp 4C","L\u1edbp 4D","L\u1edbp 4E","L\u1edbp 5A","L\u1edbp 5B","L\u1edbp 5C","L\u1edbp 5D","L\u1edbp 5E","L\u1edbp 5G"]},"labels":{"formatter":{"formatter":""}},"dataLabels":{"formatter":{"formatter":""}},"yAxis":{"style":{},"title":{"text":""}},"credits":{"enabled":false}}
    );
    
    //for column drilldown
    function setChart(name, categories, data, color) {
        mywrapperd2.xAxis[0].setCategories(categories);
        mywrapperd2.series[0].remove();
        mywrapperd2.addSeries({
            name: name,
            data: data,
            color: color || 'white'
        });
    }   
});
//]]>
</script>							</div>
							</td>
							
					</table>
					</div>
				</div> 
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="widget">
						<h4 class="widget-title">Bảng thống kê <span>nhóm sinh viên</span></h4>
						</div>
					</div>
					<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tr>
							<th>Tên nhóm</th>
							<th>Tổng số</th>
							<th>Hoạt động</th>
							<th>Đang chờ</th>
							<th>Đình chỉ</th>
						</tr>
						
						<tr>
							<td>Lớp 3A</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</tr>
																		
					</table>
					</div>
				</div> 
			</div>
			</div>
			</div>
			<div class="col-md-12"><div class="row">
			<div  class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="widget">
						<h4 class="widget-title">Tổng quát <span>Câu hỏi ngân hàng</span></h4>
						</div>
					</div>				
					<div class="chart">
					<div id="piewrapperqc"></div>
					<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
    // HIGHROLLER - HIGHCHARTS UTC OPTIONS 
    Highcharts.setOptions(
        {"global":{"useUTC":true}}
    );
    // HIGHROLLER - HIGHCHARTS 'Question Count' pie chart

    var piewrapperqc = new Highcharts.Chart(
        {"chart":{"renderTo":"piewrapperqc","type":"pie"},"title":{"text":"Question Count","align":"center"},"series":[{"name":"Total Question","data":[["Tin h\u1ecdc l\u1edbp 3",12]]}],"plotOptions":{"pie":{"dataLabels":{"style":{},"enabled":true,"format":"{point.name}:<b>{point.y}<\/b>"},"formatter":{"formatter":""},"showInLegend":true}},"xAxis":{},"credits":{"enabled":false}}
    );
    
    //for column drilldown
    function setChart(name, categories, data, color) {
        piewrapperqc.xAxis[0].setCategories(categories);
        piewrapperqc.series[0].remove();
        piewrapperqc.addSeries({
            name: name,
            data: data,
            color: color || 'white'
        });
    }   
});
//]]>
</script>					</div>
				</div>
			</div>
			<div  class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="widget">
						<h4 class="widget-title">Biểu đồ <span>Câu hỏi khó</span></h4>
						</div>
					</div>				
					<div class="chart">
					<div id="mywrapperdl"></div>
					<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
    // HIGHROLLER - HIGHCHARTS UTC OPTIONS 
    Highcharts.setOptions(
        {"global":{"useUTC":true}}
    );
    // HIGHROLLER - HIGHCHARTS 'Question Bank Difficulty Wise' column chart

    var mywrapperdl = new Highcharts.Chart(
        {"chart":{"renderTo":"mywrapperdl","type":"column"},"title":{"text":"Question Bank Difficulty Wise"},"series":[{"name":"Easy","data":[9]},{"name":"Normal","data":[2]},{"name":"Difficult","data":[1]}],"legend":{"enabled":true,"layout":"vertical","align":"right","verticalAlign":"middle"},"plotOptions":{"series":{"series":{"dataLabels":{"style":{}}},"column":null,"stacking":"percent"},"column":{"series":{"dataLabels":{"style":{}}},"column":null,"dataLabels":{"style":{},"enabled":true,"color":"white"}}},"xAxis":{"categories":["Tin h\u1ecdc l\u1edbp 3"]},"labels":{"formatter":{"formatter":""}},"dataLabels":{"formatter":{"formatter":""}},"yAxis":{"style":{},"title":{"text":""}},"credits":{"enabled":false}}
    );
    
    //for column drilldown
    function setChart(name, categories, data, color) {
        mywrapperdl.xAxis[0].setCategories(categories);
        mywrapperdl.series[0].remove();
        mywrapperdl.addSeries({
            name: name,
            data: data,
            color: color || 'white'
        });
    }   
});
//]]>
</script>					</div>
				</div>
			</div>
			</div></div>
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="widget">
						<h4 class="widget-title">Bảng <span>Câu hỏi</span></h4>
						</div>
					</div>	
					<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tr>
							<th>Tên ngân hàng thi</th>
							<th>Tổng</th>
							<th>Câu hỏi dễ</th>
							<th>Câu hỏi trung bình</th>
							<th>Câu hỏi khó</th>
						</tr>
												<tr><td>Tin học lớp 3</td>
						<td>12</td>
												<td>9</td>
												<td>2</td>
												<td>1</td>
												</tr>
													
							
					</table>
					</div>
				</div> 
			</div>
		</div>
		<script type="text/javascript">
	function examResult(id)
	{
		document.post_req.id.value=id;
		document.post_req.submit();
	}
</script>		</div>
	</div>
	    </div>







@stop