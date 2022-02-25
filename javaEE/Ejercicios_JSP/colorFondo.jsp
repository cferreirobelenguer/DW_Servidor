<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Prueba de JSP:ejemplo02.jsp</title>
</head>
<%
//Coge de un formulario el parámetro bgColor y si no es nulo hay color si no el color de defecto es blanco
String bgColor = request.getParameter("bgColor");
boolean hasExplicitColor;
if (bgColor != null) {
	hasExplicitColor = true;
	} 
	else {
	hasExplicitColor = false;
	bgColor = "WHITE";
}
%>
<body>
<BODY BGCOLOR="<%= bgColor %>">
<H2 ALIGN="CENTER">Color de Fondo</H2>
<%
if (hasExplicitColor) {
   out.println("Establecido el color de fondo:" + bgColor + ".");
  } 
else {
   out.println("Usando los colores de fondo por defecto."+ bgColor);
}
%>
</BODY>
</HTML>
