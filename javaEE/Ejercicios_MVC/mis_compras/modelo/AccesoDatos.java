package modelo;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;


public class AccesoDatos 
{

	private static AccesoDatos modelo;
	private Connection conexion = null;
	private PreparedStatement sentenciaComprar = null;
	private PreparedStatement sentenciaProducto = null;
	private PreparedStatement sentenciaUsuario = null;
	
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
					"jdbc:mysql://localhost/comprasdb?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC", "root", ""); //Para arreglar el problema de zona horaria de phpMyADMIN

			sentenciaComprar = conexion.prepareStatement("UPDATE socios SET cantidad_max=cantidad_max - ? WHERE cod_socio=?"); //Update
			
			sentenciaProducto = conexion.prepareStatement("SELECT * from productos where cod_pro = ?"); //Objeto producto
			
			sentenciaUsuario = conexion.prepareStatement("SELECT * from socios where cod_socio = ? and clave = ?"); //Objeto usuario  (si tengo que devolver una lista de usuarios se hace con ArrayList [mirar ejercicio telefonía])
			
		} catch (Exception ex) {
			System.err.println(" Error - En la base de datos.");
			ex.printStackTrace();
		}
	}
	
	public Socios comprobarUsuario(String codCliente, String clave)  //Como queremos todos los datos del socio con codigo x, creamos un objeto Socio
	{
		Socios soc = null;
		ResultSet rs;
		
		try 
		{
			sentenciaUsuario.setString(1, codCliente); //Se sustituye el primer ' ? ' por cod_socio,  SIEMPRE SUSTUTUIR EN ORDEN
			sentenciaUsuario.setString(2, clave);
			rs = sentenciaUsuario.executeQuery(); //Ejecutamos consulta
			
			if(rs.next()) 
			{
				soc = new Socios();							  //Asignamos valores.
				soc.setCod_socio(rs.getString("cod_socio"));  //Nombres de las tablas de bbdd (tal cual este  escrito en la bbdd)
				soc.setNombre(rs.getString("nombre"));
				soc.setClave(rs.getString("clave"));
				soc.setCantidad_max(rs.getInt("cantidad_max"));
			}
		}
		catch (SQLException e)
		{
			e.printStackTrace();
		}
		return soc;
	}
	
	public Productos comprobarProducto(String codProducto) 
	{
		
		Productos pro = null;
		ResultSet rs;
		try 
		{
			this.sentenciaProducto.setString(1, codProducto);
			rs = sentenciaProducto.executeQuery();
			
			if(rs.next()) 
			{
				pro = new Productos();
				pro.setCod_pro(rs.getString("cod_pro"));  //Esto son los nombres de las tablas en la bbdd
				pro.setNombre_pro(rs.getString("nombre_pro"));
				pro.setPrecio(rs.getInt("precio"));
			}
		}
		catch (SQLException e)
		{
			e.printStackTrace();
		}
		return pro;
	}
	

	
	
	public boolean compraRealizada(Productos prod, String codCliente) // LOS UPTDATE SIEMRPE son BOOLEAN, se actualiza o no seactualiza.
	{
		boolean resu = false;
		ResultSet rs;
		
		try 
		{
			sentenciaComprar.setInt(1, prod.getPrecio());
			sentenciaComprar.setString(2, codCliente);
			resu = sentenciaComprar.execute();
		}
		catch (SQLException e)
		{
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
