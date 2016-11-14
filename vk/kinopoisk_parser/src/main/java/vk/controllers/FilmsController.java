package vk.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.stereotype.Controller;
import vk.models.repositories.FilmRepository;
import org.springframework.ui.Model;
import org.jsoup.select.Elements;
import org.jsoup.nodes.Document;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import org.jsoup.Jsoup;
import vk.models.Film;
import java.util.List;

@Controller
public class FilmsController {
    @Autowired FilmRepository filmRepository;

    @RequestMapping("/top")
    public String showTop(Model model) {
        List<Film> films = filmRepository.findByRankNotNullOrderByRankAsc();
        model.addAttribute("films", films);

        return "top";
    }

    @ResponseBody
    @RequestMapping("/top/update")
    public String updateTop(@RequestParam(value = "from", required = false) Integer from,
                            @RequestParam(value = "to", required = false) Integer to) throws Exception {
        Document topPage = Jsoup.connect("https://www.kinopoisk.ru/top/").get();
        int filmsAmount = grabFilmsAmount(topPage);

        // Request Parameters validation
        from = (from == null)? 1 : from;
        to = (to == null)? filmsAmount : to;
        if (from > to || from < 1 || to > filmsAmount) {
            throw new Exception("'From' cannot be more then 'to', 'from' should be > 0, 'to' should be <= " + filmsAmount);
        }

        for(int rank = from; rank <= to; rank++) {
            String filmUrl = topPage.select("#top250_place_" + rank + " a[href]").first().attr("abs:href");
            Document filmPage = Jsoup.connect(filmUrl).get();
            Film film = grabFilm(filmPage);

            // Post grabbing
            long id = grabIdFromFilmUrl(filmUrl);
            film.setId(id);
            film.setRank(rank);

            filmRepository.save(film);
        }

        return "Grabbing succeeded. Films from " + from + " to " + to + " were updated";
    }

    @RequestMapping("/films/{id}")
    public String showFilm(@PathVariable long id, Model model) {
        Film film = filmRepository.findOne(id);
        model.addAttribute("film", film);

        return "film";
    }

    private Film grabFilm(Document html) {
        String name = html.select("#headerFilm h1").text();
        String imgUrl = html.select("a.popupBigImage img").first().attr("abs:src");

        Elements infoTable = html.select("#infoTable tr");
        String year = infoTable.get(0).select("a").text();
        String country = infoTable.get(1).select("a").text();
        String genres = infoTable.get(10).select("a").text();

        // Post handling - remove not 'genre' links
        genres = genres.replace("слова", "");
        genres = genres.replace("... ", "");

        return new Film(name, imgUrl, year, country, genres);
    }
    private int grabFilmsAmount(Document html) {
        return html.select("tr[id^=\"top250_place_\"]").size();
    }
    private Long grabIdFromFilmUrl(String url) throws Exception {
        Pattern p = Pattern.compile("film/(\\d+)/");
        Matcher m = p.matcher(url);

        if (m.find()) {
            String result = m.group(1);
            return Long.parseLong(result);
        } else {
            throw new Exception("Cannot grab film id");
        }
    }
}
