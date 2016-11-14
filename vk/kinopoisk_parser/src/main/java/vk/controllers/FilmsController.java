package vk.controllers;

import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;
import vk.models.Film;
import vk.models.repositories.FilmRepository;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Collection;

@Controller
public class FilmsController {
    @Autowired
    FilmRepository filmRepository;

    @RequestMapping("/top_250")
    public String showTop250(Model model) {
        ArrayList<Film> films = makeCollection(filmRepository.findAll());
        model.addAttribute("films", films);

        return "top_250";
    }

    @RequestMapping("/top_250/{id}")
    public String showTop250(@PathVariable long id, Model model) {
        Film film = filmRepository.findOne(id);
        model.addAttribute("film", film);

        return "film";
    }

    @ResponseBody
    @RequestMapping("/top_250/update")
    public String update() {
        String url = "https://www.kinopoisk.ru/top/";
        StringBuilder response = new StringBuilder();

        try {
            Document indexDocument = Jsoup.connect(url).get();

            for(int i = 1; i <= 5; i++) {
                String film_url = indexDocument.select("#top250_place_" + i + " a[href]").first().attr("abs:href");

                Document filmDocument = Jsoup.connect(film_url).get();

                String imgUrl = filmDocument.select("#wrap a").first().attr("src");
                String name = filmDocument.select("#headerFilm h1").text();

                Elements infoTable = filmDocument.select("#infoTable tr");

                String year = infoTable.get(1).select("a").text();
                String country = infoTable.get(2).select("a").text();

                Elements genres = infoTable.get(11).select("a");
                String genre = "";
                for (Element oneGenre : genres) {
                    genre += oneGenre.text() + " ";
                }

                Film film = new Film(imgUrl, name, year, country, genre);
                //filmRepository.save(film);

                // For debug
                response.append("film" + i + ": " + film.toString() + "<br/><br/>");
            }

            response.append("OK");
            return response.toString();
        } catch (IOException e) {
            return "Grabbing failed";
        }
    }

    public ArrayList<Film> makeCollection(Iterable<Film> iter) {
        ArrayList<Film> list = new ArrayList<Film>();
        for (Film item : iter) {
            list.add(item);
        }
        return list;
    }
}

