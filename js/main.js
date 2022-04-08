const URL_FILMS = "php/ReadFilms.php";
const URL_INDIVIDUS = "php/ReadIndividus.php";

let LesFilms
let LesIndividus
const xhr_Films = new XMLHttpRequest();
xhr_Films.open("get", URL_FILMS);
xhr_Films.onreadystatechange = function () {
        if (xhr_Films.readyState === 4 && xhr_Films.status === 200) {
            const object = JSON.parse(xhr_Films.response);
            LesFilms = object.body
            LesFilms.forEach(film => {
                display_films(film, "#LaListeDesFilms")
                display_films(film, "#LaListeDesFilms_Delete")
                display_films(film, "#LaListeDesFilms_Update")
                display_films(film, "#LaListeDesFilms_Acteurs_Delete")
            });
        };
    }
xhr_Films.send();

const xhr_Individus = new XMLHttpRequest();
xhr_Individus.open("get", URL_INDIVIDUS);
xhr_Individus.onreadystatechange = function () {
        if (xhr_Individus.readyState === 4 && xhr_Individus.status === 200) {
            const object = JSON.parse(xhr_Individus.response);
            LesIndividus = object.body
            LesIndividus.forEach(UnIndividu => {
                display_Individu(UnIndividu,"#LaListeDesIndividus")
                display_Individu(UnIndividu,"#LaListeDesIndividus_Delete")
                display_Individu(UnIndividu,"#LaListeDesIndividus_Film")
                display_Individu(UnIndividu,"#LaListeDesIndividus_Update")
                display_Individu(UnIndividu,"#LaListeDesIndividus_Film_Update")
                
            });
        };
    }
    xhr_Individus.send();

// Montrer les Films pour la mise à jour ou suppression    
function display_films(UnFilm, UneValiseHTML){
    document.querySelector(UneValiseHTML).innerHTML += "<option value="+UnFilm.NumFilm+">"+UnFilm.Titre+"</option>"
}
// La même chose mais avec les utilisateurs
function display_Individu(UnIndividu, UneValiseHTML){
    document.querySelector(UneValiseHTML).innerHTML += "<option value="+UnIndividu.NumInd+">"+UnIndividu.Nom+" "+UnIndividu.Prenom+"</option>"

}