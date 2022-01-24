package tema06;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet(name = "CookieServlet", urlPatterns = {"/CookieServlet"})
public class CookieServlet extends HttpServlet {

    /**
	 * 
	 */
	private static final long serialVersionUID = 1L;

	protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
		//Coge el nombre de la cookie
        String nombreNuevaCookie = request.getParameter("cookie");
        //Coge el valor de la cookie
        String valor = request.getParameter("valor");
        //Declaro la variable duración donde luego voy a meter el parseInt del getParameter("duracion")
        int duracion;
        try {
        	//Coge el valor de la duración
        	//Los valores de la cookie son string, hay que hacer un parseInt para pasar a int
            duracion = Integer.parseInt(request.getParameter("duracion"));
        } catch (NumberFormatException e) {
            duracion = -1;
        }
        //setContentType parece relacionado con el UTF-8 
        response.setContentType("text/html;charset=UTF-8");
        //getWriter se usa para escribir código html
        PrintWriter out = response.getWriter();
        try {
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet que muestra las cookies</title>");
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Las cookies que has recibido de esta web son:</h1>");
            out.println("<ul>");
            
            //Si no hay cookie, su valor es null se crea la cookie
            if (nombreNuevaCookie != null && valor != null
                    && !nombreNuevaCookie.equals("")) {
            	//Se crea la cookie
                Cookie nuevaCookie = new Cookie(nombreNuevaCookie, valor);
                //Se configura la duración
                nuevaCookie.setMaxAge(duracion);
                //Añado el cookie
                response.addCookie(nuevaCookie);
                //Imprimo el nombre de la cookie, valor de la cookie,  
                out.println("<li><b>" + nuevaCookie.getName() + ": </b>"
                        + nuevaCookie.getValue() + "; fecha de expiracion: "
                        + nuevaCookie.getMaxAge() + "</li>");
            }
            //Se pasa la cookie a un array
            Cookie[] todasLasCookies = request.getCookies();
            //Si el valor del array no hay null, osea hay contenido, se lee el contenido
            if (todasLasCookies != null) {
            	//Se lee el contenido de la cookie con un for
                for (Cookie cookie : todasLasCookies) {
                    out.println("<li><b>" + cookie.getName() + ": </b>"
                            + cookie.getValue() + "-, fecha de expiracion: "
                            + cookie.getMaxAge() + "</li>");
                }
            }

            out.println("</ul>");
            out.println("<a href=/cursojavaee/tema6/FormularioCookies.html>"+
                    "Volver a la pagina anterior</a><br/>");
            out.println("</body>");
            out.println("</html>");
        } finally {
            out.close();
        }
    }
	//Se ejecuta en cada instancia por get, dentro de doGet se ejecuta processRequest que es la función donde se crea la Cookie
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);


    }
  //Se ejecuta en cada instancia por get, dentro de doGet se ejecuta processRequest que es la función donde se crea la Cookie
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);

    }
}
