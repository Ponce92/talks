/**
 *  Funcionamiento de switches y mas...
 */
var element = document.querySelector('#sw1');

var switch1= new Switchery(element,{
    size:'small'
    });
element.onchange=function () {
    reloadFormSw(element.id,element.checked);
}
// ---------------------
var element2 = document.querySelector('#sw2');

var switch2= new Switchery(element2,{
    size:'small'
});
element2.onchange=function () {
    reloadFormSw(element2.id,element2.checked);
}
