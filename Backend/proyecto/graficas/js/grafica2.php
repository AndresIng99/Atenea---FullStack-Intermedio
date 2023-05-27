<script>
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