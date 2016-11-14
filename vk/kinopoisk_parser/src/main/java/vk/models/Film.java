package vk.models;

import javax.validation.constraints.NotNull;
import javax.persistence.*;
import lombok.Data;

@Data
@Entity
@Table(name = "films")
public class Film {
    @Id private long id;
    private long rank;

    @NotNull private String imgUrl;
    @NotNull private String name;
    @NotNull private String year;
    @NotNull private String country;
    private String genres;

    public Film() {}
    public Film(String name, String imgUrl, String year, String country, String genres) {
        this.name = name;
        this.imgUrl = imgUrl;
        this.year = year;
        this.country = country;
        this.genres = genres;
    }

    // For debug purposes
    @Override public String toString() {
        return "" + id + ") Name: " + name + "; imgUrl: " + imgUrl + "; year: " + year + "; country: " + country + "; genres: " + genres + "; rank: " + rank;
    }
}

