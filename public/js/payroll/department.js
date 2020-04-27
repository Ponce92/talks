$('#btn-jobs').click();
$('#btn-pos').click();

/**
 * Autor: Azael Ponce   \
 * Paramentos: url-> url donde se realizara la consulta.
 *             target-> Elemento donde se pintara la informacion, se reemplasa dicho contenido
 *             modal->el modal que sera lanzado cuando el contenido este listo.
 */
function showGetModal(url,target,modal) {
    console.log('get modal funcition');
    $.ajax({
        url:url,
        type:'get',
        success: function (data) {
            $(target).html(data.html);
            $(modal).modal('show');
        },
        statusCode: {
            404: function() {
                alert('Servidor no encontrado');
            }
        },
        error:function(x,xs,xt){
            //nos dara el error si es que hay alguno
            //window.open(JSON.stringify(x));
            //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
        }
    });
}

/**
 * Autor: Azael Ponce
 * Paramentros: id->el id del elemento a agregar
 *              btn->boton a dar click cuando finalice la peticion
 *              url->la url de la peticion
 * Descripcion: Funcion que realiza la peticion de agregar una posision al departamento
 *              una vez finalizado se da click al boton para que actualice el contenido.
 */
function addPositionDep(id,btn,url) {
    console.log('get modal funcition');
    var token =$('#token').val();
    var dep=$('#dep').val();

    $.ajax({
        url:url,
        headers:{'X-CSRF-TOKEN':token},
        data:{'idDep':dep,'idPos':id},
        type:'POST',
        success: function (data) {
            if(data.status='success'){
                showMesssage('success','Operacion completada exitosamente');
                $(btn).click();
            }else{
                showMesssage('danger','No se pudo completar la transaccion');
            }
        },
    });
}

/**
 *Author: Azael Ponce
 * @param url: url donde
 * @param target: elemento donde se pintara el resultado.
 */
function reloadPositions(url,target) {
    $.ajax({
        url:url,
        type:'get',
        success: function (data) {
            $(target).html(data.html);
        },
        statusCode: {
            404: function() {
                alert('Servidor no encontrado');
            }
        },
        error:function(x,xs,xt){
            //nos dara el error si es que hay alguno
            //window.open(JSON.stringify(x));
            //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
        }
    });
}


/**
 * Author: Azael Poce
 * Paramentros: url-> Url  donde se realizara la peticion. . .
 *              target-> Url
 * Descripcion: Funcion que actualiza los puestos de trabajo asignados
 */
function reloadDiv(url,target) {
    $.ajax({
        url:url,
        type:'get',
        success: function (data){
            $(target).html(data.html);
        },
        statusCode: {
            404: function() {
                showMesssage('danger','No se ha podido contactar al servidor');
            }
        },
    });
}
