<?php

session_start();
include '../db/conexion.php';

		if(!ISSET($_SESSION['usuario'])){
			header('location: ../index.html');
		}else{
            //Código para inactividad de página web
            /*
			if((time() - $_SESSION['time']) > 30){
				header('location: ../db/logout.php');
			}*/
            echo "";
		}

        $query_cars = mysqli_query($conexion,"SELECT * FROM carros");
        $query_cars2 = mysqli_query($conexion,"SELECT * FROM carros");

        /*Lógica para gráfica*/
        $cant = 0;
        while ($consult_graf = mysqli_fetch_array($query_cars2)){
            $array_marca[$cant] = $consult_graf['marca'];
            $array_ventas[$cant] = $consult_graf['ventas'];
            $cant++;
        }

        $datosX = json_encode($array_marca);
        $datosY = json_encode($array_ventas);


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!--Llamado a librerias-->
    <script src="https://cdn.plot.ly/plotly-2.20.0.min.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/27010df775.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js'></script>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.0.1/model-viewer.min.js"></script>

    <title>Proyecto de gráficas</title>
</head>
<body>
    <section id="content-main">
        <div class="menu-main">
            <img src="img/logo.png" alt="">
            <nav>
                <ul>
                    <li>
                        <a href=""><i class="fa-solid fa-car"></i></a>
                    </li>
                    <?php
                        if ($_SESSION['rol'] == 1) {?>
                                <li>
                                <a href=""><i class="fa-solid fa-cloud-sun"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa-solid fa-wallet"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa-solid fa-comments"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa-solid fa-gift"></i></a>
                                </li>
                    <?php
                        }else{
                            echo '';
                        }
                    ?>
                    
                </ul>
                <div class="icon-android">
                    <a href="../db/close.php"><i class="fa-solid fa-robot"></i></a>
                </div>
            </nav>
        </div>

        <div class="shop_cars">
            <h2>C. shop</h2>
            <div class="element_ind">
                <img class="rotate_car" src="img/car1.png" alt="car1">
                <span>Veyron</span>
            </div>
            <div class="element_ind">
                <img src="img/car2.png" alt="car1">
                <span>G. sport</span>
            </div>
            <div class="element_ind">
                <img src="img/car3.png" alt="car1">
                <span>Centodieci</span>
            </div>
        </div>

        <div class="graphic-main">
            <div class="content-card-one">
                <div class="indiv left">
                    <div class="icon-ind">
                        <i class="fa-regular fa-handshake"></i>
                    </div>
                    <div class="cont-info">
                        <h3>75 %  <span>Reliability num.</span></h3>
                    </div>
                    <h4>R.<span>9.5</span></h4>
                </div>
                <div class="indiv">
                    <div class="icon-ind green">
                        <i class="fa-regular fa-handshake"></i>
                    </div>
                    <div class="cont-info">
                        <h3>97 %  <span>Owner satisfaction.</span></h3>
                    </div>
                    <h4>R.<span>9.9</span></h4>
                </div>
            </div>
            <div class="graphic">
                <div id='myDiv'></div>
            </div>
            <div class="graphic">
                <div id='myDiv2'></div>
            </div>
        </div>

        <div class="tridimensional">
            <h3>Insertar datos</h3>
            <form action="../back/insert_cars.php" method="POST">
                <input type="text" name="name_car" placeholder="Nombre de carro">
                <input type="number" name="sold_car" placeholder="cantidad de ventas">
                <input type="submit" name="insert_car" value="Enviar">
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">TABLA DE VENTA DE AUTOS</th>
                    </tr>
                </thead>
                <tr>
                    <th>Marca</th>
                    <th>Ventas</th>
                </tr>
                <?php
                    while ($row = mysqli_fetch_array($query_cars)) {
                        $marca = $row['marca'];
                        $ventas = $row['ventas'];

                    echo '
                    <tr>
                        <td>'.$marca.'</td>
                        <td>'.$ventas.'</td>
                    </tr>
                    ';
                    }
                ?>
            </table>

        </div>

        
        
    </section>

    <script type="text/javascript">
    function crearArreglo(json){
        var parsed = JSON.parse(json);
        var arr = [];
        for (var x in parsed){
            arr.push(parsed[x]);
        }
        return arr;
    }   

        $datosX = crearArreglo('<?php echo $datosX ?>');
        $datosY = crearArreglo('<?php echo $datosY ?>');

        var trace1 = {
            x: $datosX,
            y: $datosY,
            line: {
                color: 'rgb(77, 209, 205)',
                shape: 'spline',
                dash: 'dashdot',
                width: 2
            },
            type: 'scatter'
            };


            var data = [trace1];


            

            Plotly.newPlot('myDiv', data);

    </script>











<script type="text/javascript">


        var data2 = [{
        values: $datosY,
        labels:  $datosX,
        type: 'pie'
        }];

        var layout = {
        height: 400,
        width: 500
        };

        Plotly.newPlot('myDiv2', data2, layout);

    </script>
</body>
</html>