
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
table, th, td {
  border: 1px solid black;
}
</style>
<title>Insert title here</title>
</head>
<body>
 <h1> Tabla del Multiplicar del  8 </h1>
 <br>
 <table>
 <%  for (int i=1; i<= 10; i++) { %>
  <tr>
    <td><%=i %> x 8 </td><td>=<td> <%=i*8 %></td>
  </tr>
 <% } %>
</table>
</body>
</html>
