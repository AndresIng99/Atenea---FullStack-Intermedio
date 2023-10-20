<script>
    $datosX = crearArreglo('<?php echo $datosX ?>');
    $datosY = crearArreglo('<?php echo $datosY ?>');

    var trace1 = {
        x: $datosX,
        y: $datosY,
        line: {
            color: 'rgb(232, 23, 44)',
            shape: 'spline',
            dash: 'solid',
            width: 2
        },
        type: 'scatter'
    };

    var data = [trace1];

    var layout = { 
        title: 'Responsive to window\'s size!',
        font: {size: 18}
    };

    

    var config = {responsive: true};

    Plotly.newPlot('myDiv', data, layout, config);
</script>