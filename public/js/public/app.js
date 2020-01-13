
// Indicamos el estilo de las notificaciones y la localizamos  la notificacion
PNotify.defaults.styling = 'bootstrap4';
window.stackBottomRight = {
    'dir1': 'up',
    'dir2': 'left',
    'firstpos1': 25,
    'firstpos2': 25
};

function showMesssage(type,msj){
    switch (type) {
        case 'info':
            PNotify.info({
                title:'Informacion',
                icon:'icon icon-info',
                text: msj,
                addClass: 'translucent',
                stack:window.stackBottomRight
            });
            break;
        case 'success':
            PNotify.success({
                title:'Completado . . .',
                text: msj,
                icon: 'icon icon-check',
                addClass: 'translucent',
                stack:window.stackBottomRight
            });
            break;
        case 'danger':
            PNotify.error({
                title:'Error . . .',
                text: msj,
                icon:'icon icon-fire',
                addClass: 'translucent',
                stack:window.stackBottomRight
            });
            break;
        case 'notice':
            PNotify.success({
                title:'Info',
                text: msj,
                icon:'icon icon-info',
                addClass: 'translucent',
                stack:window.stackBottomRight
            });
            break;
    }
}



