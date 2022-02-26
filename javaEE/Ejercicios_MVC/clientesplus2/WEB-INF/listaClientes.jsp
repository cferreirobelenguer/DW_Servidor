<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
  
<%-- Importo las clases necesarias --%>
<%@ page  import="java.util.ArrayList" %>
<%@ page import="modelo.Cliente" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Listado de Clientes </title>
</head>
<body>


<!--  UTILIZANDO INSTRUCCIONES DE JAVA  -->
<%
ArrayList <Cliente> lista = (ArrayList <Cliente>) request.getAttribute("lista");
if (lista == null){
    	out.println( " Me han enviado una lista == NULL");
    	
}
else {
 	  // Si hay alguna Cliente
   	  if ( lista.size() != 0 ) {
   		  int contador = 0;
	  %>
	<%--El JSP también puede acceder a los parámetros de la petición --%>
	<br>
	<P><h1> Lista de Clientes</h1></P>

	<table border="1">
	<tr>
	<th>Teléfono</th>
	<th>Nombre</th>
	<th>Puntos</th>
	<%
	for (Cliente l : lista) {%>
	<tr>
	<td><%= l.getTelefono() %></td>
	<td><%= l.getNombre() %></td>
	<td><%= l.getPuntos() %></td>
	</tr>
	<% contador++; 
	} %>
	</table>
 		<p> Se han encontrado <b><%=contador %></b> Clientes
	<% } else { %>
     <p> No se han encontrado ningún cliente.</p>

<%  }
} %> 	

</body>
</html>
