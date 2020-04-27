
function loadPostResult(url,target) {
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
    });
}

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
            }
        },
        error:function(x,xs,xt){
        }
    });
}

/**
 *
 * @param form
 * @param target
 */
function loadCardPostAjax(form,target) {
    var url =form.attr('action');
    var method=form.attr('method');
    var token =$('#token').val();

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
            if(data.resp=='success'){
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
