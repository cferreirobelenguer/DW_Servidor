<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
    
<%@ page  import="java.util.ArrayList" %>
<%@ page import="modelo.Vehiculo" %>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>VEHICULOS DISPONIBLES</title>
</head>
<body>

<%
ArrayList <Vehiculo> lista = (ArrayList <Vehiculo>) request.getAttribute("listaVehiculos");
if (lista == null){
    	out.println( " Me han enviado una lista == NULL");
    	
}
else {
 	  // Si hay alguna Cliente
   	  if ( lista.size() != 0 ) {
   		  int contador = 0;
	  %>
<h1>Bienvenido/a, ${clienteNombre} </h1> <h2>Lista de Vehiculos: </h2>
<table border="1">
	<tr>
	<th>Codigo coche</th>
	<th>Bateria</th>
	<%
	for (Vehiculo v : lista) {%>
	<tr>
	<td><%= v.getCod_car() %></td>
	<td><%= v.getBateria() %></td>
	</tr>
	<%contador++; 
	} %>
	</table>
	 		<p> Se han encontrado <b><%=contador %></b> Vehiculos
	<% } else { %>
     <p> No se ha encontrado ningún vehiculo.</p>

<%  }
} %> 	
	
<h2>Ha reservado el vehiculo con código: </h2> <h2> ${vehiculoMax}</h2>
</body>
</html>
