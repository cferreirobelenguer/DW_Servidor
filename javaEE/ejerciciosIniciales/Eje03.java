


import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Eje03
 */
@WebServlet("/Eje03")
public class Eje03 extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public Eje03() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
    //La petición es por get
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		//Se configura el UTF-8
		response.setContentType("text/html;charset=UTF-8");
		//Se cogen los valores de los parámetros usuario,clave
		String usuario  = request.getParameter("usuario");
		String clave    = request.getParameter("clave");
		//Se escribe el html
		PrintWriter out = response.getWriter();
        try {
        	out.println("<html><body>");
        	//Si usuario y clave no son nulos se compara si usuario y clave introducidos son igual a alumno
        	if ( usuario != null && clave != null &&
        		 usuario.contentEquals("alumno") &&
        		   clave.contentEquals("alumno") ) {
        		//Si es así se da bienvenido al sistema
        		out.println ("<h1> Bienvenido al sistema </h1>");
        	}
        	else {
        		out.println("<body><h1> ACCESO NO AUTORIZADO </h1><BR>"
        		        + " Introduzca un usuario y contraseÃ±a correctos </body></html>");
        		// RedirecciÃ³n con Header
        		//Te manda a acceso.html
        		response.setHeader("Refresh", "3; URL=acceso.html");
        		
        	}
        	out.println("</body></html>");
     
	    } finally { 
        out.close();
    }
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
