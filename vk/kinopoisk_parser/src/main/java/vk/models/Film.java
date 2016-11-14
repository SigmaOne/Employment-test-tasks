package vk.models;

import lombok.Data;
import javax.persistence.*;
import javax.validation.constraints.NotNull;

@Data
@Entity
@Table(name = "top_films")
public class Film {
    @Id @GeneratedValue(strategy = GenerationType.AUTO)
    private long id;

    @NotNull private String imgUrl;
    @NotNull private String name;
    @NotNull private String year;
    @NotNull private String country;
    private String genres;

    public Film() {}
    public Film(String imgUrlm, String name, String year, String country, String genre) {
        this.imgUrl = imgUrl;
        this.name = name;
        this.year = year;
        this.country = country;
        this.genres = genre;
    }

    @Override public String toString() {
        return "ImgUrl: " + imgUrl + "Name: " + name + "; year: " + year + "; country: " + country + "; genres: " + genres;
    }
}

