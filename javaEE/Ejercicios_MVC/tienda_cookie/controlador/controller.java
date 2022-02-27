package controlador;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import modelo.AccesoDatos;
import modelo.clientes;
import modelo.tiendas;

@WebServlet({"/controller", "/carritodatos"})

public class controller extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public controller() {
        super();
        // TODO Auto-generated constructor stub
    }

	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		AccesoDatos ac = AccesoDatos.initModelo();
		String camiseta=request.getParameter("carrito");
		PrintWriter out = response.getWriter();
		Cookie [] cookies = request.getCookies ();
		Cookie nuevo = new Cookie("productoelegido",camiseta);
		response.addCookie(nuevo);
		if(camiseta!=null) {
			tiendas resultado=ac.buscarFoto(camiseta);
			if(resultado!=null) {
				
				request.setAttribute("imagenElegida", nuevo.getValue()); //Lo usamos para pasar el mensaje a la vista
				request.setAttribute("ciudadProducto", "de la ciudad "+resultado.getLocalidad()); //Lo usamos para pasar el mensaje a la vista
				request.getRequestDispatcher("/WEB-INF/carritoCompra.jsp").forward(request, response);
			}
		}else {
			request.setAttribute("mensajeError", "Error: No se ha podido procesar"); //Lo usamos para pasar el mensaje a la vista
			request.getRequestDispatcher("/WEB-INF/error.jsp").forward(request, response);
		}
	}

}
