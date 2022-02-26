package modelo;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;



//Implemento el modelo con  PatrÃ³n Singleton es casi equivalente a crear a conexiÃ³n
//en el mÃ©todo init de Servlet

public class AccesoDatos {

	private static AccesoDatos modelo;
	private Connection conexion = null;
	private PreparedStatement sentenciapreparada = null;
	private PreparedStatement sentenciapreparadaMAX = null;
	
	public static synchronized  AccesoDatos initModelo(){
		if (modelo == null){
			modelo = new AccesoDatos();
		}
		return modelo;
	}
	
	// Creo un lista de alimentos, podrÃ­a obtenerse de una base de datos
	private AccesoDatos (){
		try {
			// Class.forName("org.apache.derby.jdbc.ClientDriver");
			Class.forName("com.mysql.jdbc.Driver");

			conexion = DriverManager.getConnection("jdbc:mysql://localhost/telefonia?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC", "root", "");

			sentenciapreparada = conexion
					.prepareStatement("select * from clientes where puntos >= ?");
			
			sentenciapreparadaMAX = conexion
					.prepareStatement("select MAX(puntos) as puntos from clientes");
			

		} catch (Exception ex) {
			System.err.println(" Error - En la base de datos.");
			ex.printStackTrace();
		}
	}
	
	
	// Devuelvo la lista de Clientes
		public ArrayList <Cliente> obtenerListaClientes (int puntos){		
			ArrayList <Cliente> listaresu= new ArrayList <Cliente> ();
			ResultSet rs;
			try {
				 // Acceso sincronizado la sentencia y la conexiÃ³n se comparten
			     synchronized (sentenciapreparada) {
			    	sentenciapreparada.setInt(1, puntos);
					rs = sentenciapreparada.executeQuery();
				
			   // Vuelco el resultado de ResultSet al ArrayList
			   while ( rs.next()) {
				    Cliente nuevo = new Cliente();
				    // En este ejercicio no es necesario rellenar todos los atributos
				    nuevo.setTelefono(rs.getInt("telefono"));
				    nuevo.setNombre  (rs.getString("nombre"));
				    nuevo.setPuntos  (rs.getInt("puntos"));
				    listaresu.add( nuevo );
			   }
			  } 
			} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
			}
		return listaresu;	
		}
	
		public int  obtenerMaxPuntos (){		
			
			int resu = 0;
			ResultSet rs;
			try {
				 // Acceso sincronizado la sentencia y la conexiÃ³n se comparten
			     synchronized (sentenciapreparadaMAX) {
					rs = sentenciapreparadaMAX.executeQuery();
				
			   // Solo hay un Ãºnico valor.
			   if ( rs.next()) {
				    resu = rs.getInt(1); // rs.getInt("puntos");
			   }
			  } 
			} catch (SQLException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
			}
		return resu;
		}
	 
	
	
	// Evito que se pueda clonar el objeto.
 @Override
 public AccesoDatos clone(){
         try {
             throw new CloneNotSupportedException();
         } catch (CloneNotSupportedException ex) {
         	ex.printStackTrace();
         }
         return null; 
     }    
}
