<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Prueba de JSP:ejemplo04.jsp</title>
</head>
<%@ page import="java.util.*" %>

<%! 
// Genero un número aleatorio entre 1 y 10
// El mismo para todos las peticiones
private int secreto = (int) (Math.random()*10.0)+1;
%>
<body>
<%
int numero;
//Cojo el parámetro número de un formulario y el programa dice si se adivinó el nº secreto
String parnum = request.getParameter("numero");
if (parnum != null) {
	// Obtengo el valor númerico de la cadena
	numero = Integer.parseInt(parnum);
	if ( numero == secreto) 
		out.println("<h1> Acertaste </h1>");
		else if ( numero < secreto) 
			out.println("<h1> Más grande </h1>");
		else 
			out.println("<h1> Más pequeño </h1>");
	}
%>
<h1> Adivina un número entre 1 y 10 </h1>	
<form   method="get">
VALOR DEL NÚMERO SECRETO: <input name="numero" type="text" size="4"><BR>
</form>
</body>
</html>
