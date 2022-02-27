
import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Pagocookie
 */
@WebServlet("/Pagocookie")
public class Pagocookie extends HttpServlet {
	private static final long serialVersionUID = 1L;

	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public Pagocookie() {
		super();
		// TODO Auto-generated constructor stub
	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		response.setContentType("text/html;charset=UTF-8");
	    PrintWriter out = response.getWriter();
	    out.println("<html>");
        out.println("<head>");
        out.println("<title>Servlet de forma de pago cookie</title>");
        out.println("</head>");
        out.println("<body>"); 
        String nuevatarjeta = request.getParameter("nuevatarjeta");
        // CAMBIO DE TARJETA
        if ( nuevatarjeta != null){
             // Ojo FALTA: por seguridad habrÃ­a que chequear que el valor del parÃ¡metro es vÃ¡lido
        	 Cookie nuevo = new Cookie("valortarjeta",nuevatarjeta);
        	 nuevo.setMaxAge(5*60); // 5 minutos
        	 response.addCookie(nuevo);
        	 out.println("<center><img src='imagenes/waiting.gif' />");
        	 out.println("<br><h1> Cambiando su tipo de tarjeta...</h1> ");
        	 response.setHeader("Refresh", "3; URL=Pagocookie");
        	 out.println("</body></html>");
        }
        else{
        // No me indican tarjeta como parÃ¡metro: comprueba el valor del cookie 
        // Obtengo las cookies
        Cookie[] todasLasCookies = request.getCookies();
        
        
        // Compruebo si existe el cookie valortarjeta
        String nombretarjeta = null;
        if (todasLasCookies != null) {
            for (Cookie cookie : todasLasCookies) {
                if ( cookie.getName().contentEquals("valortarjeta") ){
                	  nombretarjeta = cookie.getValue();
                }
            }           
        }           
       String mensaje = "SELECCIONE UNA TARJETA DE CREDITO";
        // Si existe el cookie 
       if ( nombretarjeta != null){
    	   out.println("<center><H2> SU FORMA DE PAGO ACTUAL ES</H2> </br>");
           out.println("<img src='imagenes/"+nombretarjeta+".gif' /></a>");
           mensaje = "SELECCIONE UNA NUEVA TARJETA DE CREDITO";
       }
       out.println("<center><br><h2>"+mensaje +"</h2></br>");
       out.println("<a href='Pagocookie?nuevatarjeta=cashu'><img  src='imagenes/cashu.gif' /></a>&ensp;");
       out.println("<a href='Pagocookie?nuevatarjeta=cirrus1'><img  src='imagenes/cirrus1.gif' /></a>&ensp;");
       out.println("<a href='Pagocookie?nuevatarjeta=dinersclub'><img  src='imagenes/dinersclub.gif' /></a>&ensp;");
       out.println("<a href='Pagocookie?nuevatarjeta=mastercard1'><img  src='imagenes/mastercard1.gif' /></a>&ensp;");
       out.println("<a href='Pagocookie?nuevatarjeta=paypal'><img  src='imagenes/paypal.gif' /></a>&ensp;");
       out.println("<a href='Pagocookie?nuevatarjeta=visa1'><img  src='imagenes/visa1.gif' /></a>&ensp;");
       out.println("<a href='Pagocookie?nuevatarjeta=visa_electron'><img  src='imagenes/visa_electron.gif' /></a>&ensp;");
       out.println("</center></body></html>");
       out.close();
        }
     }

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doPost(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
	}

}
