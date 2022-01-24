

import java.io.IOException;
import java.io.PrintWriter;
import java.util.HashMap;
import java.util.Random;
import java.util.Set;

import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Eje05
 */
@WebServlet("/Eje05")
public class Eje05 extends HttpServlet {
	private static final long serialVersionUID = 1L;
	//Se crea el hasmap la clave es el medio y el valor el url como un atributo privado
	private HashMap<String, String> map = new HashMap<String, String>();

	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public Eje05() {
		super();
		// TODO Auto-generated constructor stub
	}

	/**
	 * @see Servlet#init(ServletConfig)
	 */
	//El init se ejecuta una vez
	//La primera vez que se ejecuta el método init creo el hashMap y se define el hashMap como un atributo de la clase
	public void init(ServletConfig config) throws ServletException {

		// Relleno el HaspMap
		map.put("El Pais", "www.elpais.es");
		map.put("El Mundo", "www.elmundo.es");
		map.put("El ABC", "www.abc.es");
		map.put("La Vanguardia", "www.vanguardia.com");
		map.put("El Mundo Today", "www.elmundotoday.com");

	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	//El método doGet se ejecuta en cada petición
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		response.setContentType("text/html;charset=UTF-8");
		PrintWriter out = response.getWriter();
		try {
			out.println("<html><head><title>Diarios</title></head><body>");
			out.println("<p><ul>");
			Set<String> lista = map.keySet();
			for (String clave : lista) {
				//Recorro el mapa
				out.println("<li> <a href=\"http://" + map.get(clave) + "\">" + clave + "</a></li>");
			}
			out.println("</ul></p>");
			// Array de Valores
			//Convierto la lista a un array
			Object tvalores[] = lista.toArray();
			// Obtengo una posiciÃ³n aleatoria
			//Obtengo una posición en función del tamaño del array
			int pos = new Random().nextInt(tvalores.length);
			out.println("<br>Medio recomendado Hoy:");
			out.println("<a href=\"http://" + map.get(tvalores[pos]) + "\">" + tvalores[pos] + "</a></li>");
			
			out.println("</body></html>");

		} finally {
			out.close();
		}
	}

}
