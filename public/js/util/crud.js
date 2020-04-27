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
                showMesssage('success','Transaccion se ha completado satisfactoriamente ...');
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
            //
            //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
        }
    });
}

/**
 * Nombre: showObject()
 * Desc: La funcion que realiza la consulta de un objeto almacenado y lo muestra en el modal correspondiente
 * Parametros: La funcion recibe la url de la peticion de conuslta..
 *
 */
function showObject(url){
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
                    showMesssage('success','Actualizacion completada exitosamente.');
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
                    showMesssage('success','Eliminacion completada exitosamente.');
                    break;
                case 'not_found':
                    modal.modal('hide');
                    dtbl.DataTable().ajax.reload();
                    showMesssage('danger','Objeto no encontrado');
                    break;
                case 'error':
                    modal.modal('hide');
                    showMesssage('danger','El objeto referido no puede ser eliminado ');
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
            //
            //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
        }
    });
}

/**
 * Author: Azael Ponce
 * Descripcion: funcion que llena un segundo select que depende de otro select
 *              valida que el select posea una option valida, limpia y llena el select. . .
 * @param url
 * @param target
 * @param element
 * @param  label
 */
function fillSelect(url,target,element,label) {
    var to_fill=$(target);
    var token =$('#token').val();
    var opt = $(element).val();
    $.ajax({
        url:url,
        type:'POST',
        headers:{'X-CSRF-TOKEN':token},
        data:{'id':opt},
        success: function (data){
            if(data.options.length > 0)
            {
                to_fill.attr('disabled',false);
            }else{
                to_fill.attr('disabled',true);
            }
            to_fill.html('');
            to_fill.append('<option value="" disabled selected>'+label+'</option>');
            for(var i in data.options)
            {
                var pivot=data.options[i];
                to_fill.append('<option value="'+pivot.id+'">'+pivot.cs_name+'</option>')
            }
        },
        statusCode: {
            404: function() {
                showMesssage('danger','No se ha podido contactar al servidor');
            }
        },
    });
}

/**
 * Author: Azael Ponce
 * @param type
 * @param element
 * Descrip: Funcion que actualiza el valor de un input
 *          tipo numeber simulando un incremento/decremnto de valor;
 */
function updateRangeInput(type,element) {
    var input=$(element);
    var num=parseInt(input.val());
    var max=input.attr('max');
    var min=input.attr('min');

    if(type == 'add' && max > num){
        num=num+1;
        input.val(num);
        return;
    }
    if(type=='less' && min<num){
        num=num-1;
        input.val(num);
    }
}
