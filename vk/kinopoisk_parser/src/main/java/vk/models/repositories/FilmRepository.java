package vk.models.repositories;

import org.springframework.data.rest.core.annotation.RepositoryRestResource;
import org.springframework.data.repository.CrudRepository;
import vk.models.Film;
import java.util.List;

@RepositoryRestResource
public interface FilmRepository extends CrudRepository<Film, Long> {
    List<Film> findByRankNotNullOrderByRankAsc();
}
