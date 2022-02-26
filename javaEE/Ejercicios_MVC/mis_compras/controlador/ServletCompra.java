import java.io.IOException;
import java.util.ArrayList;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import modelo.AccesoDatos;
import modelo.Socios;
import modelo.Productos;

@WebServlet({"/Servletclientes", "/realizarcompra"})  // <- El action="", del formulario.
public class ServletCompra extends HttpServlet 
{
	private static final long serialVersionUID = 1L;
	
	/**
     * @see HttpServlet#HttpServlet()
     */
	  public ServletCompra() 
	  {
		  super();
	        // TODO Auto-generated constructor stub
	   }
	  
	  /**
		 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
		 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException
	{
		AccesoDatos ac = AccesoDatos.initModelo();  //Para llamar a las funciones que ejecutan las consultas
		
		String codigoCliente = request.getParameter("codigoCli");  //Estos son los datos de los elementos del formulario HTML
		String claveCliente = request.getParameter("clave");
		String codigoProducto = request.getParameter("codigoPro");
		

		if((codigoCliente != null) || (claveCliente != null) || (codigoProducto != null)) 
		{
			Socios cliente = ac.comprobarUsuario(codigoCliente, claveCliente);
			Productos producto = ac.comprobarProducto(codigoProducto);
			if(cliente != null || producto != null) 
			{
				if((cliente.getCantidad_max()) < producto.getPrecio()) 
				{
					request.setAttribute("mensajeError", "Error: Precio de producto superior al saldo"); //Lo usamos para pasar el mensaje a la vista
					request.getRequestDispatcher("/WEB-INF/errorCantidad.jsp").forward(request, response);;
				}
				else 
				{
					ac.compraRealizada(producto, codigoCliente);
					request.setAttribute("usuario", cliente.getNombre());
					request.setAttribute("compra", ", Compra realizada");
					request.getRequestDispatcher("/WEB-INF/vista.jsp").forward(request, response);;
				}
			}
		}
		
		request.getRequestDispatcher("index.html");
	}
	
	
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		// TODO Auto-generated method stub
	}
}
