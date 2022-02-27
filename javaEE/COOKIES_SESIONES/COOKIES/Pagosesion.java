



import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 * Servlet implementation class Pagosesion
 */
@WebServlet("/Pagosesion")
public class Pagosesion extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public Pagosesion() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
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
        // Obtengo la sesion
    	HttpSession sesion = request.getSession();
    	
        // CAMBIO DE TARJETA
        if ( nuevatarjeta != null){
             // Ojo FALTA: por seguridad habrÃ­a que chequear que el valor del parÃ¡metro es vÃ¡lido
        	sesion.setAttribute("valortarjeta",nuevatarjeta);
        	sesion.setMaxInactiveInterval(5*60);; // 5 minutos
        	out.println("<center><img src='imagenes/waiting.gif' />");
        	out.println("<br><h1> Cambiando su tipo de tarjeta...</h1> ");
        	response.setHeader("Refresh", "3; URL=Pagosesion");
        	out.println("</body></html>");
        }
        else{
        	// No me indican tarjeta como parÃ¡metro: compruebo si  el valortarjeta esta guardado en la sesiÃ³n 
        	
        	String nombretarjeta = null;
        	// Si estÃ¡ definido en al session
        	if ( sesion.getAttribute("valortarjeta") != null ){
        	  nombretarjeta = sesion.getAttribute("valortarjeta").toString();     
        	}
        	
        // GENERO EL MENSAJE DONDE MUESTRO LA TARJETA ACTUAL Y LAS OPCIONES 	 
       String mensaje = "SELECCIONE UNA TARJETA DE CREDITO";
        // Si existe el valor en la sesion
       if ( nombretarjeta != null){
    	   out.println("<center><H2> SU FORMA DE PAGO ACTUAL ES</H2> </br>");
           out.println("<img src='imagenes/"+nombretarjeta+".gif' /></a>");
           mensaje = "SELECCIONE UNA NUEVA TARJETA DE CREDITO";
       }
       out.println("<center><br><h2>"+mensaje +"</h2></br>");
       out.println("<a href='Pagosesion?nuevatarjeta=cashu'><img  src='imagenes/cashu.gif' /></a>&ensp;");
       out.println("<a href='Pagosesion?nuevatarjeta=cirrus1'><img  src='imagenes/cirrus1.gif' /></a>&ensp;");
       out.println("<a href='Pagosesion?nuevatarjeta=dinersclub'><img  src='imagenes/dinersclub.gif' /></a>&ensp;");
       out.println("<a href='Pagosesion?nuevatarjeta=mastercard1'><img  src='imagenes/mastercard1.gif' /></a>&ensp;");
       out.println("<a href='Pagosesion?nuevatarjeta=paypal'><img  src='imagenes/paypal.gif' /></a>&ensp;");
       out.println("<a href='Pagosesion?nuevatarjeta=visa1'><img  src='imagenes/visa1.gif' /></a>&ensp;");
       out.println("<a href='Pagosesion?nuevatarjeta=visa_electron'><img  src='imagenes/visa_electron.gif' /></a>&ensp;");
       out.println("</center></body></html>");
       out.close();
        }

	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
	}

}
