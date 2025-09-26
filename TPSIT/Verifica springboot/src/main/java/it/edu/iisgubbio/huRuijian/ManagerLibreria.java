package it.edu.iisgubbio.huRuijian;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Example;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class ManagerLibreria {
	@Autowired
	LibroRepository archivioLibri;
	@Autowired
	PrestitoRepository archivioPrestiti;
	
	@GetMapping("/libri")
	public List<Libro> mostraLibri(
			@RequestParam(required = false) String titolo,
			@RequestParam(required = false) String autore,
			@RequestParam(required = false) Boolean prestabile
			){
		Libro esempio = new Libro();
		esempio.setTitolo(titolo);
		esempio.setAutore(autore);
		esempio.setPrestabile(prestabile);
		Example<Libro> tipoLibro = Example.of(esempio);
		return archivioLibri.findAll(tipoLibro);
	}
	
	@GetMapping("/libro/{id}")
	public Optional<Libro> mostraLibro(@PathVariable Integer id) {
		return archivioLibri.findById(id);
	}
	
	@PostMapping("/aggiungiLibro")
	public void insertLibro(@RequestBody Libro libro) {
		archivioLibri.save(libro);
	}
	
	@GetMapping("/prestiti")
	public List<Prestito> prestitiSpecifici(@RequestParam String cf){
		Prestito esempio = new Prestito();
		esempio.setCf(cf);
		Example<Prestito> tipoPrestito = Example.of(esempio);
		return archivioPrestiti.findAll(tipoPrestito);
	}
	
	@PostMapping("/libro/{id}/aggiungiPrestito")
	public Optional<String> insertPrestito(
			@PathVariable Integer id,
			@RequestBody Prestito prestito) {

		Libro libro = archivioLibri.findById(id).orElseThrow(() -> new RuntimeException("Libro non trovato"));	
		if(libro.getPrestabile()) {
			prestito.setLibro(libro);
			archivioPrestiti.save(prestito);
		}else {
			return Optional.of("Non prestabile al monento");
		}
		return null;
	}
}
