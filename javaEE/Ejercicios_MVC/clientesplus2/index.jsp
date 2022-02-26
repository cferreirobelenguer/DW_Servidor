<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Consulta de puntos</title>
</head>
<body>
<div align="center">	
<H1> CONSULTA DE PUNTOS DE LOS CLIENTES </H1>
<HR>
<% 
   // Obtengo el valor de máximo de puntos
   Integer maxpuntos = (Integer) session.getAttribute("maxpuntos");
%>
<script>
function validar() {
  valor=parseInt(document.nombreFormulario.puntos.value );
  puntosmaxjs = <%=maxpuntos %> ;
if(valor> puntosmaxjs) {
   alert("El valor supera el máximo actual");
   return false;
  }
return true;
}
</script>
<div>
<form action="verpuntos" name="nombreFormulario" method="get" 
<% if (maxpuntos != null){  %>
onsubmit="return validar()">
<% } %>

<input name="puntos" type="text" size="8" MAXLENGTH="4" value="0"><BR>

</form>
</div>
</body>
</html>
