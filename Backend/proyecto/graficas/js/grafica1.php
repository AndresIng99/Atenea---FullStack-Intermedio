<script>
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