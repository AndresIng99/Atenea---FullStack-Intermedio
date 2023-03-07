function fechaActual() {
    document.getElementById('table').style.display="block";
    // Select div
    const div = document.querySelector('.fecha');

    // Apply style to div
    div.setAttribute('style', 'display: block');

    document.querySelector('div').setAttribute('style','display: block');
    
}
function agregarHtml() {
    document.getElementById('mi_contenedor').innerHTML = "<p>esto es un parrafo</p>";
    
}