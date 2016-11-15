package vk.controllers;

import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.junit4.SpringRunner;
import org.jsoup.nodes.Document;
import org.junit.runner.RunWith;
import java.io.IOException;
import org.jsoup.Jsoup;
import org.junit.Test;
import vk.models.Film;

@RunWith(SpringRunner.class)
@SpringBootTest
public class FilmsControllerTests {
    private FilmsController filmsController = new FilmsController();

	@Test public void grabFilmTest() throws Exception {
		String filmUrl = "https://www.kinopoisk.ru/film/535341/";
        Film film = filmsController.grabFilm(filmUrl);

        assert(film.getId() == 0);
        assert(film.getRank() == null);
        assert(film.getName().equals("1+1"));
        assert(film.getCountry().equals("Франция"));
        assert(film.getImgUrl().equals("https://st.kp.yandex.net/images/film_iphone/iphone360_535341.jpg"));
        assert(film.getCountry().equals("Франция"));
        assert(film.getYear().equals("2011"));
        assert(film.getGenres().equals("драма, комедия, биография"));
	}

	@Test public void grabFilmsAmountTest() throws IOException {
		Document pageWithTopFilms = Jsoup.connect("https://www.kinopoisk.ru/top/").get();
		int filmsAmount = filmsController.grabFilmsAmount(pageWithTopFilms);
        assert(filmsAmount == 250);
	}

	@Test public void grabIdFromFilmUrlTest() throws Exception {
        Long result = filmsController.grabIdFromFilmUrl("https://www.kinopoisk.ru/film/535341/");
        assert(result == 535341);
	}

	@Test public void matchRegexTest() {
	    String moneyRegex = "\\$\\d+";
	    assert(filmsController.matchRegex("$322", moneyRegex));
        assert(!filmsController.matchRegex("триллер, комедия, криминал", moneyRegex));
    }
}
