package modelo;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import modelo.Usuario;

public class AccesoDatos {
	private static AccesoDatos modelo;
	private Connection conexion = null;
	private PreparedStatement busqueda=null;
	

	public static synchronized  AccesoDatos initModelo(){
		if (modelo == null){
			modelo = new AccesoDatos();
		}
		return modelo;
	}
	// Creo una conexion a la base d datos, asignamos conexion (nombrebd,root,root) y preparamos consultas.
		private AccesoDatos ()
		{
			try {
				// Class.forName("org.apache.derby.jdbc.ClientDriver");
				Class.forName("com.mysql.jdbc.Driver");

				conexion = DriverManager.getConnection(
						"jdbc:mysql://localhost/proyecto_web_jsp?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC", "root", ""); //Para arreglar el problema de zona horaria de phpMyADMIN
	
				busqueda=conexion.prepareStatement("SELECT * FROM usuarios WHERE Usuario=? and Contrasena=?");
				
			} catch (Exception ex) {
				System.err.println(" Error - En la base de datos.");
				ex.printStackTrace();
			}
		}
		public Usuario comprobar(String usuario, String contra) {
			Usuario usu=null;
			ResultSet rs;
			
			try {
				this.busqueda.setString(1, usuario);
				this.busqueda.setString(2, contra);
				rs=busqueda.executeQuery();
				if(rs.next()) {
					usu=new Usuario();
					usu.setUsuario(rs.getString("usuario"));
					usu.setContra(rs.getString("contra"));
				}
				
			}
			catch (SQLException e) {
				e.printStackTrace();
			}
			return usu;
		}
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
