package modelo;

public class Socios  //Getters y Setters automaticos ->  En el menu de arriba -> Source-Generate getters/setters
{
	private String cod_socio;
	private String nombre;
	private String clave;
	private Integer cantidad_max;
	
	public String getCod_socio() {
		return cod_socio;
	}
	public void setCod_socio(String cod_socio) {
		this.cod_socio = cod_socio;
	}
	public String getNombre() {
		return nombre;
	}
	public void setNombre(String nombre) {
		this.nombre = nombre;
	}
	public String getClave() {
		return clave;
	}
	public void setClave(String clave) {
		this.clave = clave;
	}
	public Integer getCantidad_max() {
		return cantidad_max;
	}
	public void setCantidad_max(Integer cantidad_max) {
		this.cantidad_max = cantidad_max;
	}
	
	
}
