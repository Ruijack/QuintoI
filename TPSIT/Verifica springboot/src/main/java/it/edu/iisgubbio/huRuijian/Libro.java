package it.edu.iisgubbio.huRuijian;

import java.util.List;

import com.fasterxml.jackson.annotation.JsonManagedReference;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.OneToMany;

@Entity
public class Libro {
	
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	Integer id;
	String isbn;
	String titolo;
	String autore;
	Boolean prestabile;
	
	@OneToMany(mappedBy = "libro")
	@JsonManagedReference
	List<Prestito> prestiti;
	
	Libro(){
		super();
	}

	public Integer getId() {
		return id;
	}

	public void setId(Integer id) {
		this.id = id;
	}

	public String getIsbn() {
		return isbn;
	}

	public void setIsbn(String isbn) {
		this.isbn = isbn;
	}

	public String getTitolo() {
		return titolo;
	}

	public void setTitolo(String titolo) {
		this.titolo = titolo;
	}

	public String getAutore() {
		return autore;
	}

	public void setAutore(String autore) {
		this.autore = autore;
	}

	public Boolean getPrestabile() {
		return prestabile;
	}

	public void setPrestabile(Boolean prestabile) {
		this.prestabile = prestabile;
	}

	public List<Prestito> getPrestiti() {
		return prestiti;
	}

	public void setPrestiti(List<Prestito> prestiti) {
		this.prestiti = prestiti;
	}
	
}
