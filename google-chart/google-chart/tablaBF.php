<html>
  <head>
  <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Generar reportes</title>
  <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

	function errorHandler(errorMessage) {
            //curisosity, check out the error in the console
            console.log(errorMessage);
            //simply remove the error, the user never see it
            google.visualization.errors.removeError(errorMessage.id);
        }
		
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
		var periodo=$("#periodo").val();//Datos que enviaremos para generar una consulta en la base de datos
		var jsonData= $.ajax({
                        url: 'chart.php',
						data: {'periodo':periodo,'action':'ajax'},
                        dataType: 'json',
                        async: false
                    }).responseText;
   
		var obj = jQuery.parseJSON(jsonData);
		var data = google.visualization.arrayToDataTable(obj);
		
		

    var options = {
      title : 'REPORTE DE KILOGRAMOS'+periodo,
      vAxis: {title: 'Kg'},
      hAxis: {title: 'Meses'},
      seriesType: 'bars',
      series: {5: {type: 'line'}}
    };
	
    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
	google.visualization.events.addListener(chart, 'error', errorHandler);
    chart.draw(data, options);
  }
  
  // Haciendo los graficos responsivos
      jQuery(document).ready(function(){
        jQuery(window).resize(function(){
         drawVisualization();
        });
      });
	  
    </script>
  </head>
  <body>



    <div class="container" style="margin-top:10px">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
	  <div class='row'>	
		<div class='col-md-4'>
			<label>Selecciona período</label>
			<select id="periodo" onchange="drawVisualization();" class="form-control">
				<option value='2017'>Período 2017</option>
				<option value='2016' selected>Período 2016</option>
				<option value='2018' >Período 2018</option>
			</select>
		</div>	
	</div>

  
  
  
        <hr>
        <div id="chart_div" style="width: 100%; height: 450px;"></div>
      </div>

    </div> <!-- /container -->
	
	
    
  </body>
</html>