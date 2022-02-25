<%@ page language="java" contentType="text/html; charset=utf-8"
    pageEncoding="utf-8"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert title here</title>
</head>
<body>
<%@ page import="java.sql.*" %>
	<%
		
		String usuario=request.getParameter("usuario");
		String contra=request.getParameter("contra");
		out.println(usuario);
		out.println(contra);
		try{
			//Se crea la conexión 
			Connection miConexion=java.sql.DriverManager.getConnection("jdbc:mysql://localhost/proyecto_web_jsp","root","");
			//Consulta que busca usuarios con el usuario y la contra que se coge del formulario
			PreparedStatement miPr=miConexion.prepareStatement("SELECT * FROM usuarios where Usuario=? and Contrasena=?");
			miPr.setString(1, usuario);
			miPr.setString(1, contra);
			ResultSet miRs=miPr.executeQuery();
			
			if(miRs.absolute(1)) out.println("Login correcto");
			else out.println("No existen usuarios con esos datos");
		}catch(Exception e){
			out.println("No se puede leer la bbdd");
		}
		
	%>
</body>
</html>
