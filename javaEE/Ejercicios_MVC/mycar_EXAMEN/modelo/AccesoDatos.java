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
	private PreparedStatement sentenciaCliente = null;
	private PreparedStatement sentenciaVehiculo = null;
	private PreparedStatement sentenciaUpdateVehiculo = null;
	private PreparedStatement sentenciaUpdateCliente = null;
	private PreparedStatement sentenciaVehiculoMaxBateria = null;
	
	public static synchronized  AccesoDatos initModelo()
	{
		if (modelo == null)
		{
			modelo = new AccesoDatos();
		}
		return modelo;
	}
	
	private AccesoDatos() 
	{
		try 
		{
			Class.forName("com.mysql.jdbc.Driver");
			conexion = DriverManager.getConnection(
					"jdbc:mysql://localhost/mycardb?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC", "root", "root"); //Para evitar error de zona horaria
			
			sentenciaCliente = conexion.prepareStatement("SELECT * from clientes WHERE cod_cli = ? AND clave = ?");
			sentenciaVehiculo = conexion.prepareStatement("SELECT * from vehiculos WHERE localidad = ?");
			sentenciaVehiculoMaxBateria = conexion.prepareStatement("SELECT * FROM `vehiculos` WHERE localidad = ? AND bateria = (SELECT MAX(bateria) FROM vehiculos) AND estado = 0");
			sentenciaUpdateVehiculo = conexion.prepareStatement("UPDATE vehiculos SET estado = ? WHERE cod_car = ?");
			sentenciaUpdateCliente = conexion.prepareStatement("UPDATE clientes SET cod_car = ? WHERE cod_cli = ?");

		}catch (Exception e)
		{
			System.err.println(" Error - En la base de datos.");
			e.printStackTrace();
		}
	}
	
	public Cliente comprobarCliente(String codCliente, String clave) 
	{
		Cliente cli = null;
		ResultSet rs;
		
		try 
		{
			sentenciaCliente.setString(1, codCliente);
			sentenciaCliente.setString(2, clave);
			rs = sentenciaCliente.executeQuery();
			
			if(rs.next()) 
			{
				cli = new Cliente();
				cli.setCod_cli(rs.getString("cod_cli"));
				cli.setNombre(rs.getString("nombre"));
				cli.setClave(rs.getString("clave"));
				cli.setCod_car(rs.getInt("cod_car"));
			}
			
		} catch (SQLException e)
		{
			e.printStackTrace();
		}
		return cli;
	}
	
	public Vehiculo vehiculoMaxBateria(String localidad) 
	{
		Vehiculo veh = null;
		ResultSet rs;
		
		try 
		{
			sentenciaVehiculoMaxBateria.setString(1, localidad);
			rs = sentenciaVehiculoMaxBateria.executeQuery();
			
			if(rs.next()) 
			{
				veh = new Vehiculo();
				veh.setCod_car(rs.getInt("cod_car"));
				veh.setLocalidad("localidad");
				veh.setEstado(rs.getInt("estado"));
				veh.setBateria(rs.getInt("bateria"));
			}
		}catch (SQLException e)
		{
			e.printStackTrace();
		}
		return veh;
	}
	
	public ArrayList <Vehiculo> comprobarVehiculo (String localidad) 
	{
		ArrayList <Vehiculo> cars = new ArrayList <Vehiculo> ();
		ResultSet rs;
		
		try 
		{
			sentenciaVehiculo.setString(1, localidad);
			rs = sentenciaVehiculo.executeQuery();
			
			while(rs.next()) 
			{
				Vehiculo veh = new Vehiculo();
				veh.setCod_car(rs.getInt("cod_car"));
				veh.setLocalidad(rs.getString("localidad"));
				veh.setEstado(rs.getInt("estado"));
				veh.setBateria(rs.getInt("bateria"));
				cars.add(veh);
			}
			
		}catch (SQLException e)
		{
			e.printStackTrace();
		}
		
		return cars;
	}
	
	public boolean actualizarVehiculo(Integer codCar) 
	{
		boolean resu = false;
		ResultSet rs;
		try 
		{
			sentenciaUpdateVehiculo.setInt(1, codCar);
			resu = sentenciaUpdateVehiculo.execute();
		}catch(SQLException e)
		{
			e.printStackTrace();
		}
		return resu;
	}
	
	public boolean actualizarCliente(Integer codCar,String codCli) 
	{
		boolean resu = false;
		ResultSet rs;
		try 
		{
			sentenciaUpdateCliente.setInt(1, codCar);
			sentenciaUpdateCliente.setString(2, codCli);
			resu = sentenciaUpdateCliente.execute();
		}catch (SQLException e)
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
