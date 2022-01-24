

package tema06;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.Enumeration;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

@WebServlet(name = "SessionServlet", urlPatterns = {"/SessionServlet"})
public class SessionServlet extends HttpServlet {

    /**
	 * 
	 */
	private static final long serialVersionUID = 1L;

	protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
		//Cojo los parámetros por request (nuevoAtributo,valor y action)
        String nuevoAtributo = request.getParameter("parametro");
        String valor = request.getParameter("valor");
        String action = request.getParameter("accion");
        //Configuro el UTF-8 de html
        response.setContentType("text/html;charset=UTF-8");
        //Con getWritter escribo código html
        PrintWriter out = response.getWriter();
        try {
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet que muestra el contenido de la sesion</title>");
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>El contenido de tu sesion es:</h1>");
            //Creo la sesión, es equivalente a $_SESSION de php
            HttpSession s = request.getSession();
            //Si el parámetro que llega de action es invalidar se hace destroy de la sesión
            if (action.equals("invalidar")) {
            	//invalidate es session_destroy() destruir la sesión
                s.invalidate();
                out.println("<h1>Sesion invalidada:</h1>");
            } else {
            	//En caso de que la action no sea invalidar se modifica el nombre de la cookie y el valor
                s.setAttribute(nuevoAtributo, valor);
                out.println("<ul>");
                // Fijo en 10 segundo el intervalo de inactividad para anular la sesion
                s.setMaxInactiveInterval(10);
                //Obtengo el nombre de los atributos
                //Se crea una clase Enumeration de tipo String que comprende los nombres de los atributos
                Enumeration<String> nombresDeAtributos = s.getAttributeNames();
                //Si nombre de los atributos tiene más elementos va leyendo los atributos
                while (nombresDeAtributos.hasMoreElements()) {
                	//Va leyendo los atributos
                    String atributo = nombresDeAtributos.nextElement();
                    out.println("<li><b>" + atributo + ": </b>"
                            + s.getAttribute(atributo) + "</li>");
                }
                //Obtiene los valores de los atributos hasta que nombreDeAtributos ya no tenga valores
                out.println("</ul>");
            }


            out.println("<a href=/cursojavaee/tema6/FormularioSesion.html>"+
                    "Volver a la pÃ¡gina anterior</a><br/>");
            out.println("</body>");
            out.println("</html>");
        } finally {
            out.close();
        }
    }
	//Se ejecuta dentro del get la función de crear la sesión
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }
  //Se ejecuta dentro del get la función de crear la sesión
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }
}
