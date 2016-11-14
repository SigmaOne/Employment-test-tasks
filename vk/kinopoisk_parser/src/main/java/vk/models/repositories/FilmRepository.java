package vk.models.repositories;

import org.springframework.data.repository.CrudRepository;
import org.springframework.data.rest.core.annotation.RepositoryRestResource;
import vk.models.Film;

@RepositoryRestResource
public interface FilmRepository extends CrudRepository<Film, Long> {}
