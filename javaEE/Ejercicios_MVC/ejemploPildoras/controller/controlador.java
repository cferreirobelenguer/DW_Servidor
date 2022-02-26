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
//Llamo al action del formulario
@WebServlet({"/controlador", "/resultados"}) 
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
		AccesoDatos ac = AccesoDatos.initModelo();  //Para llamar a las funciones que ejecutan las consultas
		//Cojo los parámetros del formulario
		String nombre=request.getParameter("nombre");
		String usuario=request.getParameter("usuario");
		String apellido=request.getParameter("apellido");
		String contra=request.getParameter("contra");
		String pais=request.getParameter("pais");
		String tecno=request.getParameter("tecnologias");
		if((nombre!=null)||(apellido!=null)||(usuario!=null)||(contra!=null)||(pais!=null)||(tecno!=null)) {
			ac.almacenarDatos(nombre, apellido, usuario, contra, pais, tecno);
			request.setAttribute("mensaje","Los datos han sido almacenados" );
			request.getRequestDispatcher("/WEB-INF/respuesta.jsp").forward(request, response);
		}else {
			request.setAttribute("error","Los datos no han podido ser almacenados" );
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
