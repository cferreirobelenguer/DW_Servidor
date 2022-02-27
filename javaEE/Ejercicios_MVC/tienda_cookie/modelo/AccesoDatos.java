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
	private PreparedStatement buscarProducto = null;
	
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
					"jdbc:mysql://localhost/comercio?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC", "root", ""); //Para arreglar el problema de zona horaria de phpMyADMIN

			buscarProducto = conexion.prepareStatement("SELECT localidad, productos FROM tiendas where productos=?"); 
			
			
		} catch (Exception ex) {
			System.err.println(" Error - En la base de datos.");
			ex.printStackTrace();
		}
	}
	
	public tiendas buscarFoto(String carrito) {
		tiendas ti=null;
		ResultSet rs;
		
		try {
			buscarProducto.setString(1, carrito);
			rs=buscarProducto.executeQuery();
			if(rs.next()) {
				ti=new tiendas();
				
				ti.setLocalidad(rs.getString("localidad"));
				ti.setProductos(rs.getString("productos"));
				
			}
		}catch(Exception e) {
			e.printStackTrace();
		}
		return ti;
		
		
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
