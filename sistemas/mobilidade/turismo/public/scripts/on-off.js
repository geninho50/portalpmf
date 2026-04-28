function Mudarestado(el,el2) {
    var display = document.getElementById(el).style.display;
    if(display == "none") { 
        document.getElementById(el).style.display = 'block';
        document.getElementById(el2).innerHTML = '- Minimizar';
}
    else {
        document.getElementById(el).style.display = 'none';
        document.getElementById(el2).innerHTML = '+ Abrir';
}

}

function mudarEstadoDetalhes(el,el2) {
    var display = document.getElementById(el).style.display;
    if(display == "none") { 
        document.getElementById(el).style.display = 'block';
        document.getElementById(el2).innerHTML = '- Minimizar';
}
    else {
        document.getElementById(el).style.display = 'none';
        document.getElementById(el2).innerHTML = '+ Detalhes';
}

}

// function show(el,el2) {
//         document.getElementById(el).style.display = 'block';
//         document.getElementById(el2).innerHTML = '-';


// }