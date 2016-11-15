$(document).ready(function() {
    $('#findFilmByIdForm').on("submit", function(e) {
        e.preventDefault(); // cancel the actual submit
        var filmId = $('#idInput').val();
        window.location.href = "/films/" + filmId;
    });
});