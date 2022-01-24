


import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class Ej02
 */
@WebServlet("/Eje02")
public class Eje02 extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public Eje02() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		
		//Se cogen los datos de los parámetros del formulario mediante get con getParameter
		String nombre = request.getParameter("nombre");
        String apellidos = request.getParameter("apellidos");
        String edad = request.getParameter("edad");
        //hobbies en el formulario es un checkbox y se almacenan los parámetros en un array
        String[] hobbies = request.getParameterValues("hobbies");
        String sexo = request.getParameter("sexo");
        //Se configura el UTF-8 con html
        response.setContentType("text/html;charset=UTF-8");
        //Se escribe html
        PrintWriter out = response.getWriter();
        try {
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet que procesa un formulario basico</title>");
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>" + "Hola " + nombre + " " + apellidos);
            if ( sexo.contentEquals("H")) {
            	//Si el sexo es hombre se muestra una imagen de hombre
            	out.println("<img src='img/hombre.png' width=\"50\" height=\"50\">");
            } else if (sexo.contentEquals("M")) {
            	// Si el sexo es mujer se muestra una imagen de mujer
            	out.println("<img src='img/mujer.png' width=\"50\" height=\"50\">");
            }
            out.println("</h1>Tu Franja de edad es " + edad + " y tus hobbies son:");

            out.println("<ul>");
            //Se muestra el valor del sexo obtenido del formulario
            out.print(" Sexo = "+ sexo);
            //Hobbies es un string ya que es un formulario checkbox y lo recorremos con un for
            //Para leer los resultados
            for (String hobby : hobbies) {
                out.println("<li>" + hobby + "</li>");
            }
            out.println("</ul>");
            
            
      

            out.println("</body>");
            out.println("</html>");
            
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
