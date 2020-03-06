function saveChangeDual(sel,rolid,url) {
    var opciones=new Array();

    $('#search_to option').each(function () {
        opciones.push($(this).val());
    });

    var token =$('#token').val();

    if (opciones.length < 1){
        showMesssage('info','No has asignado ningun permiso');
        return 0;
    }else{
        $.ajax({
            url:url,
            data:{opt:opciones,id:rolid},
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
    }


}

