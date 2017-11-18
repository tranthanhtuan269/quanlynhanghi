@extends('layouts.app')

@section('content')
<script src="{{ url('/') }}/public/highcharts/highcharts.js"></script>
<script src="{{ url('/') }}/public/highcharts/modules/exporting.js"></script>
<div class="row">
	<div class="col-md-12">
		<div class="content-box-header">
			<div class="panel-title">Test</div>
			</div>
			<div class="content-box-large box-with-header">
		        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var date = new Date();
	var XCat = new Array();
	var YCat = new Array();
	var $tempX = "{{ json_encode($XList) }}"; 
	var $tempY = "{{ $YList }}"; 

	var dataa = JSON.parse($tempY.replace(/&quot;/g,'"'));
	$.each( dataa, function( key, value ) {
		var datab = new Array();
		$.each( $(this)[0].data, function( key, value ) {
			datab.push(parseInt(value));
		});

		var obj = {};
		obj.name = $(this)[0].name;
		obj.data = datab;
	  	YCat.push(obj);
	});

	var resX = $tempX.split("[&quot;");
	var resX1 = resX[1].split("&quot;]");
	var resX2 = resX1[0].split("&quot;,&quot;");


    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Stacked column chart'
        },
        xAxis: {
            categories: resX2
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total fruit consumption'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -15,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: YCat
    });
</script>
@endsection