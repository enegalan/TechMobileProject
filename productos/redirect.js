function redireccionarColor(currentColor, nextColor) {
    // Obtener la URL actual
    var url = window.location.href;

    // Remover el parámetro 'color=grey' de la URL
    url = quitarParametroURL(url, 'color', currentColor);

    // Agregar el parámetro 'color=red' a la URL
    url = agregarParametroURL(url, 'color', nextColor);

    // Redireccionar a la nueva URL
    window.location.href = url;
}

// Función para remover un parámetro de la URL
function quitarParametroURL(url, key, value) {
    var updatedUrl = url;
    var regex = new RegExp("([?&])" + key + "=" + value + "(&|$)", "i");
    updatedUrl = url.replace(regex, '$1');
    updatedUrl = updatedUrl.replace(/&$/, '');
    return updatedUrl;
}

// Función para agregar un parámetro a la URL
function agregarParametroURL(url, key, value) {
    var updatedUrl = url;
    if (url.indexOf('?') > -1) {
        updatedUrl += '&' + key + '=' + value;
    } else {
        updatedUrl += '?' + key + '=' + value;
    }
    return updatedUrl;
}