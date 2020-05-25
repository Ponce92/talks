
/**
 *
 * @param id name of switch
 * @param pivot value of te switch
 */
function reloadFormSw(id,pivot){
    var sw=$('#'+id);
    var target=sw.attr('data-target');

    if(pivot==true){
        url=sw.attr('on-url');
    }else{
        url=sw.attr('off-url');
    }
    $.ajax({
        url:url,
        type:'get',
        success: function (data) {
            if(data.status=="success"){
                 $(target).html(data.html);
                // document.getElementById("employeeTrg").innerHTML = "Paragraph changed!";
            }
        },
        statusCode: {
            404: function() {
                showMesssage('danger',"El server no ha sido localizado");
                // alert('Servidor no encontrado');
            }
        }
    });
}

/**
 *
 * @param form
 * @param target
 */
function updateFromCard(form,target,sw){
    $.ajax({
        url:form.action,
        type:"PUT",
        data:$('#'+form.id).serialize(),
        success: function (data) {

            switch (data.status)
            {
                case "success":
                    showMesssage('success','Transaccion completada exitosamente');
                   $(sw).click();
                    break;
                case 'form_error':
                    showMesssage('notice','Formulario contiene errores porfavor corriga e intentente de nuevo');
                    $(target).html(data.html);
                break;
            }

        },
        statusCode: {
            404: function() {
                showMesssage('danger',"El server no ha sido localizado");
                // alert('Servidor no encontrado');
            },
            500:function () {
                showMesssage('danger',"El servidor a fallado en realizar la transaccion...!");
            }

        }
    });
}

/**
 *
 */
function loadCardAjax(url,target) {
    $.ajax({
        url:url,
        type:'get',
        success: function (data) {
            target.html(data.html);
        },
        statusCode: {
            404: function() {
                alert('Servidor no encontrado');
            },
            500:function ()
            {
                showMesssage('danger','Error 500, el servidor a fallado al realizar la transaccion.')
            }

        },
    });
}

/**
 *
 * @param form
 * @param target
 */
function loadCardPostAjax(form,target) {
    var url =form.attr('data-url');
    var method=form.attr('method');
    var token =$('#token').val();
    console.log(url);

    $.ajax({
        url:url,
        headers:{'X-CSRF-TOKEN':token},
        data:form.serialize(),
        type:method,
        success: function (data) {
            if(data.status=="success")
            {
                dtbl.DataTable().ajax.reload();
                showMesssage('success','Transaccion completada');
            }
            if(data.status=="form_errors")
            {
                showMesssage('notice','Se encontraron errrores en el formulario, porfavor corriga e intente nuevamente');
            }

                target.html(data.html);
        },
        statusCode: {
            404: function() {
                showMesssage('danger',"El servidor no se encuentra disponible en este momento...!");
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
 *
 * @param p_url
 * @param p_name
 * @param p_id
 * @returns {number}
 */
function saveChangeTreeCheckbox(p_url,p_name,p_id) {
    var opciones=new Array();
    var token =$('#token').val();
    var str='input:checkbox[name='+p_name+']:checked';

    $(str).each(function () {
        opciones.push($(this).val());
    });
    if(opciones.length<1){
        showMesssage('notice',"No se encontraron elementos seleccionados");
        return 0;
    }


    $.ajax({
        url:p_url,
        data:{opt:opciones,id:p_id},
        headers:{'X-CSRF-TOKEN':token},
        method:'POST',
        dataType:'json',
        success: function (data) {
            if(data.status=='success'){
                showMesssage('success','Permisos asignados correctamente');
            }else {
                showMesssage('danger','Error en la ejecucion de la sentencia ');
            }
        },
        statusCode: {
            404: function() {
                showMesssage('danger','El servidor no ha sido encontrado, recargue la pagina y vuelva a intentarlo');
            }
        },
        error:function(x,xs,xt){
            //nos dara el error si es que hay alguno
            showMesssage('danger','El servdior a respondido con un status de errro.')
            //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
        }

    });
    return 0;
}

/**
 *====================================================================================
 *  Funciones que muestran un modal ya sea ajax o no
 *====================================================================================
 */
function showLoadedModal(url,modal,target) {
    $.ajax({
        url:url,
        type:'get',
        success: function (data) {
            switch (data.status)
            {
                case 'success':
                    target.html(data.html);
                    modal.modal('show');
                    break;
                case 'error':
                    showMesssage('notice',data.html);
                    break;
            }
            target.html(data.html);
            modal.modal('show');
        },
        statusCode: {
            404: function() {
                showMesssage('danger',"Servidor inaccesible");
            },
            500:function () {
                showMesssage('danger',"El servidor a fallado al processar la peticion");
            }
        },
    });
}
/**
 *====================================================================================
 *====================================================================================
 *
 */
function loadRequestPost(form,modal,target)
{

    var url =form.attr('data-url');
    var method=form.attr('method');
    var token =$('#_token').val();


    $.ajax({
        url:url,
        headers:{'X-CSRF-TOKEN':token},
        data:form.serialize(),
        type:method,
        success: function (data) {
            switch(data.status){
                case 'success':
                    modal.modal('hide');
                    showMesssage('success','Transaccion completada con exito.');
                    dtbl.DataTable().ajax.reload();
                    target.html(data.html);
                    break;
                case 'form_errors':
                    target.html(data.html);
                    break;
            }
        },
        error:function(x,xs,xt){
            showMessage('error','El servidor ha repondido con un status error o no ha sido contactado');
        }
    });

}

/**
 *====================================================================================
 *====================================================================================
 * @param card
 */
function clearCard(card) {
    var html='<center><i class="fas fa-laptop-code trg-clear"></i></center>';
    card.html('');
    card.html(html);

}



/**
 *====================================================================================
 *  Funion que obtienen los puestos por area y department     ...... =================
 * ====================================================================================
 */
function getPuesto(url,area,departamento,target,modal)
{
    $.ajax({
        url:url,
        data:{area:area.val(),departamento:departamento.val()},
        headers:{'X-CSRF-TOKEN':token},
        method:'GET',
        dataType:'json',
        success: function (data)
        {
            target.html(data.html);
            modal.modal('show');
        },
        statusCode: {
            404: function()
            {
                showMesssage('danger','El servidor no ha sido encontrado, recargue la pagina y vuelva a intentarlo');
            },
            500:function ()
            {
                showMesssage('danger','El servidor a fallado al completar la transaccion');
            },
            405:function ()
            {
                showMesssage('danger',"El servidor desconoce la peticion realizada");
            }
        },
    });

}




/**
 * Author: Azael Ponce
 * Descripcion: funcion que llena un segundo select que depende de otro select
 *              valida que el select posea una option valida, limpia y llena el select. . .
 */
function fillSelect(element,targetElement) {

    $.ajax({
        url:element.attr('data-url'),
        type:'GET',
        data:{departamento: element.val()},
        success: function (data){
            targetElement.html('');
            targetElement.append('<option value="" selected disabled> Seleccione area</option>');

            if( data.options.length <1)
            {
                showMesssage('info',data.msj);
                targetElement.attr('disabled',true);
                return 0;
            }
            targetElement.attr('disabled',false);
            for(var i in data.options)
            {
                var pivot=data.options[i];
                targetElement.append('<option value="'+pivot.id+'">'+pivot.cs_name+'</option>')
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
 * Funcion que envia un id al serve le pasa
 */

