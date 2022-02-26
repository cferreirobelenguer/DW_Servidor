package modelo;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

public class AccesoDatos {
	private static AccesoDatos modelo;
	private Connection conexion = null;
	private PreparedStatement insertarDatos = null;
	
	public static synchronized  AccesoDatos initModelo(){
		if (modelo == null){
			modelo = new AccesoDatos();
		}
		return modelo;
	}
	private AccesoDatos (){
		try {
			// Class.forName("org.apache.derby.jdbc.ClientDriver");
			Class.forName("com.mysql.jdbc.Driver");

			conexion = DriverManager.getConnection("jdbc:mysql://localhost/proyecto_web_jsp?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC", "root", "");

			insertarDatos = conexion.prepareStatement("INSERT INTO USUARIOS (Nombre,Apellido,Usuario,Contrasena,Pais,Tecnologia) VALUES(?,?,?,?,?,?)");
			
			

		} catch (Exception ex) {
			System.err.println(" Error - En la base de datos.");
			ex.printStackTrace();
		}
	}
	
	public boolean almacenarDatos(String nombre,String apellidos, String usuario, String contra, String pais, String tecno) {
		boolean resu=false;
		ResultSet rs;
		
		try {
			insertarDatos.setString(1,nombre);
			insertarDatos.setString(2, apellidos);
			insertarDatos.setString(3, usuario);
			insertarDatos.setString(4, contra);
			insertarDatos.setString(5, pais);
			insertarDatos.setString(6, tecno);
			
			resu = insertarDatos.execute();
		}catch(Exception e) {
			e.printStackTrace();
		}
		
		
		return resu;
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
