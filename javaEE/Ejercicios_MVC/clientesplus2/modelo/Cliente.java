package modelo;

/*
 * Bean que mapea la entidad cliente
 */
public class Cliente {

	private int telefono;
	private String nombre;
	private int puntos;
	  
	
	public int getTelefono() {
		return telefono;
	}
	public String getNombre() {
		return nombre;
	}
	public int getPuntos() {
		return puntos;
	}
	public void setTelefono(int telefono) {
		this.telefono = telefono;
	}
	public void setNombre(String nombre) {
		this.nombre = nombre;
	}
	public void setPuntos(int puntos) {
		this.puntos = puntos;
	}
	
}
