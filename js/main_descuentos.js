// prueba de Script js dolibarr




$(function(){
    
        $('#tabs').tab(); // inicializo las tabs
        var prod_select= $('#select_prod');

        recaga_producto(prod_select);
        
        

});






function recaga_producto(elemento){

elemento.on("change",function(){

console.log('redireccionar id '+ elemento.val())
window.location.href="http://localhost/dolibar_local/htdocs/descuentos/prueba_list.php?action=listar&id="+ elemento.val()

});

//window.location.href=pagina
};