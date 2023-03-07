const rm = document.querySelector(".rm");
const barca = document.querySelector(".barca");
const juve = document.querySelector(".juve");


function cambiarAzul() {
    rm.style.display = "block";
    barca.style.display = "none";
    juve.style.display = "none";
}
function cambiarRojo() {
    barca.style.display = "block";
    rm.style.display = "none";
    juve.style.display = "none";
}
function cambiarBlanco() {
    juve.style.display = "block";
    barca.style.display = "none";
    rm.style.display = "none";
}