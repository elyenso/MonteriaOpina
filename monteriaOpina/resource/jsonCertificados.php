<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Certificados en Linea</title>
		<link rel="stylesheet" href="resource/css/bootstrap.min.css">
        <link rel="stylesheet" href="resource/css/bootstrap-theme.css">
        <link rel="stylesheet" href="resource/css/bootstrap-theme.css.map">
        <link rel="stylesheet" href="resource/css/bootstrap-theme.css">
        



	</head>
	<body>
		<div class="container">
<br>
<div class=" col-md-12">
     <a href="?c=Usuario&a=HomeCiudadano" id="btn-signup" type="submit" class="btn btn-success"><i class="icon-hand-right"></i> &nbsp Regresar </a>
</div>
<br>
<br>
<br>

<div  id="piechart">
 </div>





<?php

   $url="http://dwunicor.com.co/certificados/?c=Certificado&a=mostrarJson";

$json= file_get_contents($url);

$datos= json_decode($json, true);





    ?>



    	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Nombre', 'Orden'],
          <?php

          $i=1;
                    foreach($datos as $r){ ?>[ <?php echo "'".$r['tipo']."'"; ?>,   <?php  echo $r['valor']; ?>], <?php $i++; if($i==10) break; }?>

    
        ]);

        var options = {
          title: 'Grafica Certificados Unicordoba'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
	
		<table class="table table-hover">
                <thead>
                <tr>
                    <th>Descripcion</th>
                    <th>Valor </th>
                    <th>Tipo</th>
				
                </tr>
                </thead>
                <tbody>
                <?php

            foreach ($datos as $key) {
			
                 echo '<tr>';
                    echo '<td>'. $key['descripcion'] . '</td>';
                    echo '<td>'. $key['valor'] . '</td>';
                    echo '<td>'. $key['tipo'] . '</td>';
                   
					



                    echo '</tr>' ;

               
            }

              ?>
                </tbody>
            </table>

 </div>

  </html>
