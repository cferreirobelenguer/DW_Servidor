<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Prueba de JSP:ejemplo01.jsp</title>
</head>
<body>
<% out.println("<h1> Hola Mundo </h1>"); %>
<UL>
<LI>Hora actual en el servidor: <%= new java.util.Date() %>
<LI>Nombre del host: <%= request.getRemoteHost() %>
<LI>Identificador de sesion: <%= session.getId() %>
<LI>Valor del parametro:
<%= request.getParameter("algo") %>
<li> Valor de la consultar URL:
<%= request.getQueryString() %>
</UL>
</body>
</html>
