

import java.io.IOException;
import java.util.ArrayList;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import modelo.AccesoDatos;
import modelo.Cliente;


/**
 * Servlet implementation class Servletclientes
 */
@WebServlet({ "/Servletclientes", "/verpuntos" })
public class Servletclientes extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public Servletclientes() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
				AccesoDatos ac =  AccesoDatos.initModelo();
			  
			    // Compruebo si el valor mÃ¡ximo de puntos esta en guardado en la sesiÃ³n
				// OJO Si cambian los valores en la BD no cambiarÃ­a el mÃ¡ximo en cada peticiÃ³n
			    HttpSession sesion = request.getSession();
			    Integer maxpuntos = (Integer) sesion.getAttribute("maxpuntos");
			    // Si no existe lo almaceno
			    if ( maxpuntos == null) {
			       Integer maxpuntosvalor = ac.obtenerMaxPuntos();
			       sesion.setAttribute("maxpuntos", maxpuntosvalor);
			    }  
				
			    // Obtengo el parÃ¡metro puntos 
				String spuntos = request.getParameter("puntos");
				int ipuntos = 0;
				boolean error = false;
				try {
				ipuntos = Integer.parseInt(spuntos);
				} catch ( NumberFormatException ex) {
					error = true;
				}
				if (error ) {
					request.setAttribute("mensaje"," Valor nÃºmerico errÃ³neo");
					request.getRequestDispatcher("/WEB-INF/error.jsp").forward(request, response);	
					return;
				}
				
				
				ArrayList <Cliente> lista = ac.obtenerListaClientes(ipuntos);
				// Obtengo los datos del modelo
				request.setAttribute("lista",lista);
				// Se lo envio a la vista
				request.getRequestDispatcher("/WEB-INF/listaClientes.jsp").forward(request, response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
