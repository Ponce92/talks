/**
 *Autor : Azael Ponce
 * Fecha creacion: 16-12-2019
 * Ultima edicion: 16-12-2019
 * Descripcion: El archivo contiene codigo de funciones js que requiere la
 *              pantalla de administracion de roles de usuarios en el sistema.
 *
 *
 */


var dtbl=$('#laravel_datatable');

/*      Create roles   */
function showCreateForm(url) {
    //Realizamos la peticion al server, retornara el formulario en html...
    $.ajax({
        url:url,
        type:'get',
        success: function (data) {
            $('#targetCreate').html(data.html);
            $('#modalCreate').modal('show');
        },
        statusCode: {
            404: function() {
                alert('Servidor no encontrado');
            }
        },
        error:function(x,xs,xt){
            showMesssage('danger','No se ha pordido contactar al servidor..')
            //nos dara el error si es que hay alguno
            //window.open(JSON.stringify(x));
            //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
        }
    });
}

function store(modal,form) {

    var url =$(form).attr('data-url');
    var token =$('#token').val();
    var form=$(form);

    $.ajax({
        url:url,
        headers:{'X-CSRF-TOKEN':token},
        data:form.serialize(),
        type:'POST',
        success: function (data) {
            //almacenamos la data en el server o mostramos el error de validacion
            if(data.valor){

                $(modal).modal('hide');
                dtbl.DataTable().ajax.reload();
                showMesssage('success','Rol almacenado correctamente ...');
            }else{
                $('#targetCreate').html(data.html);
            }
        },
        statusCode: {
            404: function() {
                alert('Servidor no encontrado');
            }
        },
        error:function(x,xs,xt){
            //nos dara el error si es que hay alguno
            showMesssage('danger','Error al contactar al servidor')
            //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
        }
    });
}

/**
 * Nombre: show()
 * Desc: La funcion que realiza la consulta de un objeto almacenado y lo muestra en el modal correspondiente
 * Parametros: La funcion recibe la url de la peticion de conuslta..
 *
 */
function showObject(url){
    //Obtenemos la instalcia del div a contener el fomrmulario y del modal que contiene el div
    var modal=$('#modalEdit');
    var target=$('#targetEdit');
    $.ajax({
        url:url,
        type:'get',
        success: function (data) {
            target.html(data.html);
            modal.modal('show');
        },
        statusCode: {
            404: function() {
                alert('Servidor no encontrado');
            }
        },
        error:function(x,xs,xt){
            //nos dara el error si es que hay alguno
            window.open(JSON.stringify(x));
            //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
        }
    });
}

function editObject() {
    //obtenemos la instalcia JavaScript de modal,token y formulario a enviar
    var form=$('#formEdit');
    var modal=$('#modalEdit');
    var token =$('#token').val();
    var target=$('#targetEdit');

    //Realizamos la peticion actualizacion...
    $.ajax({
        url:form.attr('data-url'),
        headers:{'X-CSRF-TOKEN':token},
        data:form.serialize(),
        type:'PUT',
        success: function (data) {
            //si la variable de estado es verdadres oculatmos el modal y notificamos
            switch (data.status) {
                case 'success':
                    modal.modal('hide');
                    target.html('');
                    dtbl.DataTable().ajax.reload();
                    showMesssage('success','Actualizacion completada.');
                    break;
                case 'fails_validation':
                    target.html(data.html);

                    break;
                case 'not_found':
                    modal.modal('hide');
                    dtbl.DataTable().ajax.reload();
                    showMesssage('danger','Objeto no encontrado');
                    break;
                case 'errors':
                    modal.modal('hide');
                    showMesssage('danger','El servidor ha respondido con un estado de error, refresaca la pagina intentalo de nuevo.');
                    break;
            }

        },
        statusCode: {
            404: function() {
                alert('Servidor no encontrado');
            }
        },
        error:function(x,xs,xt){
            //nos dara el error si es que hay alguno
            window.open(JSON.stringify(x));
            //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
        }
    });

}

function confirmTrash(url,id) {
    $('#delete_input').attr('data-url',url);
    $('#modalTrash').modal('show');
}

function deleteObject() {
    var url=$('#delete_input').attr('data-url');
    var modal=$('#modalTrash');
    var token =$('#token').val();

    //Realizamos la peticion actualizacion...
    $.ajax({
        url:url,
        headers:{'X-CSRF-TOKEN':token},
        method:'DELETE',
        dataType:'json',
        success: function (data) {

            //si la variable de estado es verdadres oculatmos el modal y notificamos
            switch (data.status) {
                case 'success':
                    modal.modal('hide');
                    dtbl.DataTable().ajax.reload();
                    showMesssage('info','Eliminacion completada exitosamente.');
                    break;
                case 'not_found':
                    modal.modal('hide');
                    dtbl.DataTable().ajax.reload();
                    showMesssage('danger','Objeto no encontrado');
                    break;
                case 'errors':
                    modal.modal('hide');
                    showMesssage('danger','El servidor ha respondido con un estado de error, refresaca la pagina intentalo de nuevo.');
                    break;
            }
        },
        statusCode: {
            404: function() {
                alert('Servidor no encontrado');
            }
        },
        error:function(x,xs,xt){
            //nos dara el error si es que hay alguno
            window.open(JSON.stringify(x));
            //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
        }
    });
}
