/**
 * Funciones auxiliares de javascripts 
 */
function confirmarBorrar(producto,id){
  if (confirm("¿Quieres eliminar el producto:  "+producto+"?"))
  {
   document.location.href="?orden=Borrar&id="+id;
  }
}