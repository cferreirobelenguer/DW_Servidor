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
		String nombre=request.getParameter("nombre");
		String apellidos=request.getParameter("apellido");
		String usuario=request.getParameter("usuario");
		String contra=request.getParameter("contra");
		String pais=request.getParameter("pais");
		String tecno=request.getParameter("tecnologias");
		try{
			Connection miConexion=java.sql.DriverManager.getConnection("jdbc:mysql://localhost/proyecto_web_jsp","root","");
			Statement miSt=miConexion.createStatement();
			String insSql="INSERT INTO USUARIOS (Nombre,Apellido,Usuario,Contrasena,Pais,Tecnologia) VALUES('"+nombre+"','"+apellidos+"','"+usuario+"','"+contra+"','"+pais+"','"+tecno+"')";
			miSt.executeUpdate(insSql);
			out.println("Usuario registrado con éxito");
		}catch(Exception e){
			e.printStackTrace();
		}
	%>
</body>
</html>
