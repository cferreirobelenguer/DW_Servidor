<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>ERROR</title>
</head>
<body>
<h2>${ErrorDisponibilidad}</h2> 
<h3>${Error}</h3>
<% response.setHeader("Refresh", "3; URL=index.html"); %>
</body>
</html>
