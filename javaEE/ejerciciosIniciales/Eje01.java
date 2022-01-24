



import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Eje01
 */
@WebServlet("/Eje01")
public class Eje01 extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public Eje01() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		
		//Dentro de doGet se configura el html UTF-8 para escribir html
		response.setContentType("text/html;charset=UTF-8");
		//Se escribe html
		PrintWriter out = response.getWriter();
		out.println("<html><body>");
		//Obtiene la información del navegador que se usa
		String detallesNavegador = request.getHeader("User-Agent");
		//Busca dentro del string obtenido por getHeader  si está Firefox
		//En caso de que el resultado no sea -1 el usuario usa Firefox
		if ( detallesNavegador.indexOf("Firefox") >= 0) {
			out.println("<h1> Usas Firefox</h1>");
		}
		else {
			//Si el resultado es -1 no usa Firefox
			out.println("<h1> No usas Firefox</h1>");
		}
		out.println("</body></html>");
				
		
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
