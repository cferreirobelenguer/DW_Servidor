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
import modelo.Vehiculo;

@WebServlet({"/Servletclientes", "/reservar"})
public class ServletAlquiler extends HttpServlet
{
	private static final long serialVersionUID = 1L;
	
	/**
     * @see HttpServlet#HttpServlet()
     */
	  public ServletAlquiler() 
	  {
		  super();
	        // TODO Auto-generated constructor stub
	   }
	  
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException
	{
		AccesoDatos ac = AccesoDatos.initModelo();
		
		String codigoCliente =  request.getParameter("cod_cli");
		String claveCliente = request.getParameter("clave");
		String localidadCliente = request.getParameter("localidad");
		Integer estado;
		Integer bateria;
		
		if((codigoCliente != null) && (claveCliente != null))
		{
			Cliente cliente = ac.comprobarCliente(codigoCliente, claveCliente);
			ArrayList vehiculos = ac.comprobarVehiculo(localidadCliente);
			Vehiculo vehiculoMaxBateria = ac.vehiculoMaxBateria(localidadCliente);
			
			
			if(cliente.getCod_car() == 0) 
			{
				for(int i = 0; i<vehiculos.size(); i++) 
				{
					Vehiculo vehiculo = (Vehiculo) vehiculos.get(i);
					estado = vehiculo.getEstado();
					bateria = vehiculo.getBateria();
					
					if(estado != 0) 
					{
						vehiculos.remove(i);
					}
					if(bateria < 10) 
					{
						vehiculos.remove(i);
					}
				}
				
				if(cliente.getCod_car() != 0) 
				{
					request.setAttribute("error1", "Ya tiene un vehiculo en alquiler");
					request.getRequestDispatcher("/WEB-INF/error.jsp").forward(request, response);
				}
				
				request.setAttribute("listaVehiculos", vehiculos);
				request.setAttribute("vehiculoMax", vehiculoMaxBateria.getCod_car());
				request.setAttribute("clienteNombre", cliente.getNombre());
				ac.actualizarCliente(vehiculoMaxBateria.getCod_car(), codigoCliente);
				ac.actualizarVehiculo(vehiculoMaxBateria.getCod_car());
				
				request.getRequestDispatcher("/WEB-INF/listaVehiculos.jsp").forward(request, response);;
			}
			else 
			{
				request.setAttribute("ErrorDisponibilidad", "ERROR: Ya tienes alquilado un vehiculo");
				request.getRequestDispatcher("/WEB-INF/error.jsp").forward(request, response);;
			}
			
			if(vehiculos == null) 
			{
				request.setAttribute("Error", "ERROR: No hay vehiculos disponibles");
				request.getRequestDispatcher("/WEB-INF/error.jsp").forward(request, response);;
			}
		}
		request.getRequestDispatcher("index.html");
	}
}
