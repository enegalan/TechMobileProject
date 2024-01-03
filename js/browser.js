document.getElementById("icon-menu") && document.getElementById("icon-menu").addEventListener("click", mostrar_menu);
document.getElementById("ctn-icon-search") && document.getElementById("ctn-icon-search").addEventListener("click", mostrar_buscador);
document.getElementById("cover-ctn-search") && document.getElementById("cover-ctn-search").addEventListener("click", ocultar_buscador);

bars_search = document.getElementById("ctn-bars-search");
cover_ctn_search = document.getElementById("cover-ctn-search");
inputSearch = document.getElementById("inputSearch");
box_search = document.getElementById("box-search");
//Mostrar el menú
function mostrar_menu() {
    document.getElementById("move-content").classList.toggle('move-container-all');
    document.getElementById("show-menu").classList.toggle('show-lateral');
}
//Mostrar el buscador
function mostrar_buscador() {
    bars_search.style.top = "66px";
    cover_ctn_search.style.display = "block";
    inputSearch.focus();
    if (inputSearch.value === "") {
        box_search.style.display = "none";
    }
}
//Ocultar el buscador
function ocultar_buscador() {
    bars_search.style.top = "-25px";
    cover_ctn_search.style.display = "none";
    inputSearch.value = "";
    box_search.style.display = "none";
}
document.getElementById("inputSearch").addEventListener("keyup", buscador_interno);
function buscador_interno() {
    filter = inputSearch.value.toUpperCase();
    li = box_search.getElementsByTagName("li");
    //Recorriendo elementos a filtrar mediante los "li"
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        textValue = a.textContent || a.innerText;
        if (textValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
            box_search.style.display = "block";
            if (inputSearch.value === "") {
                box_search.style.display = "none";
            }
        }
        else {
            li[i].style.display = "none";
        }
    }
}

