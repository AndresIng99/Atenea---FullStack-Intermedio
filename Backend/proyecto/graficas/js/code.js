function crearArreglo(json){
    var parsed = JSON.parse(json);
    var arr = [];
    for (var x in parsed){
        arr.push(parsed[x]);
    }
    return arr;
}