package controller;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import modelo.AccesoDatos;
import modelo.Usuario;

/**
 * Servlet implementation class controlador
 */
@WebServlet({"/controlador", "/capturalogin"})  // <- El action="", del formulario.

public class controlador extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public controlador() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		AccesoDatos ac = AccesoDatos.initModelo();
		String usuario=request.getParameter("usuario");
		String contrasena=request.getParameter("contra");
		Usuario cliente=null;
		if((usuario!=null)||(contrasena!=null)) {
			
			cliente=ac.comprobar(usuario, contrasena);
			if(cliente!=null) {
				request.setAttribute("mensaje",cliente.getUsuario()+" registrado correctamente");
				request.getRequestDispatcher("/WEB-INF/vistaMensaje.jsp").forward(request, response);
			}else {
				request.setAttribute("errorMensaje", "Error");
				request.getRequestDispatcher("/WEB-INF/errorMensaje.jsp").forward(request, response);
			}
			}else {
			request.setAttribute("errorMensaje", "Error");
			request.getRequestDispatcher("/WEB-INF/errorMensaje.jsp").forward(request, response);
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
