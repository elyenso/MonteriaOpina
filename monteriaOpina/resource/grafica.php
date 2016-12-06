

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
<div class="col-md-9">
 <a href="?c=Usuario&a=HomeEdil" id="btn-signup" type="submit" class="btn btn-success"><i class="icon-hand-right"></i> &nbsp Regresar </a>
</div>
<br>
<br>
<br>




<?php

   $url="https://www.datos.gov.co/resource/9hqb-t2mb.json";

$json= file_get_contents($url);

$datos= json_decode($json, true);





    ?>


<div class="col-md-4">
                                  
                          	
				<select class="form-control" name="producto" id="producto">
					<option value=" ">Selecciona una EPS</option>
          <?php
					foreach ($datos as $e){
				      //echo	'<option value='."$e['producto']/$e['cantidad']".'>'.$e['producto'].'</option>';
              echo "<option  value='".$e["epszona"]."/".$e["total"]."'>".$e["epszona"]."</option>"; 
        }
					?>
				
				</select>
			</div>

        <div class="col-md-4">
				
				<select class="form-control" name="cantidad" id="cantidad">
					<option value=" ">Selecciona una EPS</option>
          <?php
					foreach ($datos as $e){
				      //echo	'<option value='."$e['producto']/$e['cantidad']".'>'.$e['producto'].'</option>';
              echo "<option  value='".$e["epszona"]."/".$e["total"]."'>".$e["epszona"]."</option>"; 
        }
					?>
				
				</select>
			</div>

       <div class="col-md-3">
            	<button class="btn btn-warning"  id="boton" onClick="graficar()" type="submit">Graficar</button>
            </div>



   <br>
            <br>
            <br>

      <div  id="piechart">


</div>




		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script type="text/javascript">

function graficar(){ 
      var datos1=document.getElementById('producto').value;
      var datos2=document.getElementById('cantidad').value;

      var vecdatos1=datos1.split("/");
       var vecdatos2=datos2.split("/");



      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

            var data = google.visualization.arrayToDataTable([
          ['Producto', 'Cantidad'],
         [ vecdatos1[0],Number(vecdatos1[1]) ],
                     [vecdatos2[0],Number(vecdatos2[1])]

          
        ]);

        var options = {
          title: 'Comparacion de EPS vs Total individualmente'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
      }
    </script>



		<table class="table table-hover">
                <thead>
                <tr>
                    <th>EPS </th>
                    <th>Zona Rural </th>
                    <th>Zona Urbana</th>
                    <th>Total</th>
				
                </tr>
                </thead>
                <tbody>
                <?php

            foreach ($datos as $key) {
			
                 echo '<tr>';
                    echo '<td>'. $key['epszona'] . '</td>';
                    echo '<td>'. $key['zonarural'] . '</td>';
                    echo '<td>'. $key['zonaurbana'] . '</td>';
                    echo '<td>'. $key['total'] . '</td>';
					



                    echo '</tr>' ;

               
            }

              ?>
                </tbody>
            </table>

 </div>

  </html>