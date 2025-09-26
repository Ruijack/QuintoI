package it.edu.iisgubbio.huRuijian;

import com.fasterxml.jackson.annotation.JsonBackReference;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;

@Entity
public class Prestito {
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	Integer id;
	String cf;
	String data_prestito;
	String data_restituzione;
	
	@ManyToOne
	@JoinColumn(name="libro_id")
	@JsonBackReference
	Libro libro;
	
	Prestito(){
		super();
	}

	public Integer getId() {
		return id;
	}

	public void setId(Integer id) {
		this.id = id;
	}

	public String getCf() {
		return cf;
	}

	public void setCf(String cf) {
		this.cf = cf;
	}

	public String getData_prestito() {
		return data_prestito;
	}

	public void setData_prestito(String data_prestito) {
		this.data_prestito = data_prestito;
	}

	public String getData_restituzione() {
		return data_restituzione;
	}

	public void setData_restituzione(String data_restituzione) {
		this.data_restituzione = data_restituzione;
	}

	public Libro getLibro() {
		return libro;
	}

	public void setLibro(Libro libro) {
		this.libro = libro;
	}
	
}
