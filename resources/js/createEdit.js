/* VECCHIO CODICE, USATO PRIMA DELLA VALIDAZIONE E DEI CONTROLLI DEL FORM CON LARAVEL */
// Quando la pagina carica(DOMContentLoaded), JavaScript imposta il max dell'input sull'anno corrente(es. 2025).
// Se un utente scrive manualmente un valore superiore(tipo "3000"), glielo corregge subito e lo porta a 2025.
document.addEventListener('DOMContentLoaded', function () {
    const yearInput = document.getElementById('release_year');
    const currentYear = new Date().getFullYear();

    yearInput.setAttribute('max', currentYear);
    // yearInput.setAttribute('min', currentYear);

    yearInput.addEventListener('input', function () {
        if (parseInt(this.value) > currentYear) {
            this.value = currentYear;
        }
    });
});


// Impostazioni al caricamento del DOMContentLoaded per la input number della durata del film:
document.addEventListener('DOMContentLoaded', function () {
    const durationInput = document.getElementById('duration');
    const maxDuration = 255;

    durationInput.addEventListener('input', function () {
        // Se l'utente inserisce un valore superiore a 255 alla input viene assegnato il valore massimo possibile: 255
        if (parseInt(this.value) > maxDuration) {
            this.value = maxDuration;
        }
        if (parseInt(this.value) < 1 && this.value !== '') {
            this.value = 1;         // Se l'utente inserisce un valore inferiore ad 1 alla input viene assegnato il valore minimo possibile: 1
        }
    });
});

// Impostazioni per la input radio del rating dei film e delle recensioni:
document.querySelectorAll('.star-rating label').forEach(star => {
    star.addEventListener('click', function () {
        this.style.transform = 'scale(1.2)';        // animazione che al click su una stella la ingrandisce
        setTimeout(() => {
            this.style.transform = 'scale(1)';      // la ingrandisce e poi la riporta com'era inizialmente, in un lasso di tempo di 200 millisecondi
        }, 200);
    });
});

// Impostazioni per la input radio del rating per selezionare e deselezionare il voto scelto (questo perchè il campo è opzionale)
// Seleziona tutti gli <input type = "radio"> dentro il contenitore.star-rating e per ognuno eseguo un forEach():
document.querySelectorAll('.star-rating input[type="radio"]').forEach(radio => {
    // Aggiunge un listener per l'evento click su ogni radio:
    radio.addEventListener('click', function () {

        // Se la stella è stata selezionata e il dataset personalizzato risulta true, allora deseleziono la stella:
        if (this.checked && this.dataset.statoSelezionato === 'true') {
            this.checked = false;
            this.dataset.statoSelezionato = 'false';
        }
        // Altrimento se la stella è non è selezionata e il dataset personalizzato risulta false, allora:
        else {
            // Resetta tutti gli altri radio: wasChecked = 'false'
            document.querySelectorAll('.star-rating input[type="radio"]').forEach(r => r.dataset.statoSelezionato = 'false');
            // Seleziona solo quello appena cliccato: statoSelezionato = 'true'.
            this.dataset.statoSelezionato = 'true';
        }
    });
});

/* -------------------------------- Codice pulsante reset del form Create/Edit Film: -------------------------------- */
const resetButton = document.getElementById('button-id-reset');
resetButton.addEventListener('click', () => {
    const title = document.getElementById('title');
    const description = document.getElementById('description');
    const release_year = document.getElementById('release_year');
    const duration = document.getElementById('duration');
    const nationality = document.getElementById('nationality');
    title.value = ""
    description.value = "";
    release_year.value = "";
    duration.value = "";
    nationality.value = "";

    // Resetta i radio button del rating
    const starRating = document.querySelectorAll('input[name="rating"]');     // oppure anche: 'input[type="radio"]'
    starRating.forEach(radio => {
        radio.checked = false;
    });
});
/* -------------------------------- Fine codice pulsante reset del form Create/Edit Film: -------------------------------- */






/* -------------------------------- Codice pulsante reset del form Create/Edit Director (registi): -------------------------------- */
const resetButtonDirector = document.getElementById('button-id-reset');
resetButton.addEventListener('click', () => {

    const firstName = document.getElementById('first_name');
    const lastName = document.getElementById('last_name');
    const birthDate = document.getElementById('birth_date');
    const nationality = document.getElementById('director_nationality');
    firstName.value = "";
    lastName.value = "";
    birthDate.value = "";
    nationality.value = "";
});
/* -------------------------------- Fine codice pulsante reset del form Create/Edit Director (registi): -------------------------------- */






/* -------------------------------- Codice pulsante reset del form Create/Edit Actor (attori): -------------------------------- */
const resetButtonActor = document.getElementById('button-id-reset');
resetButton.addEventListener('click', () => {

    const firstName = document.getElementById('first_name');
    const lastName = document.getElementById('last_name');
    const birthDate = document.getElementById('birth_date');
    const nationality = document.getElementById('actor_nationality');
    firstName.value = "";
    lastName.value = "";
    birthDate.value = "";
    nationality.value = "";
});
/* -------------------------------- Fine codice pulsante reset del form Create/Edit Actor (attori): -------------------------------- */






/* -------------------------------- Codice pulsante reset del form Create/Edit Genre (generi): -------------------------------- */
const resetButtonGenre = document.getElementById('button-id-reset');
resetButton.addEventListener('click', () => {

    const name = document.getElementById('name');
    const genreDescription = document.getElementById('genre_description');
    const genreColor = document.getElementById('color');
    name.value = "";
    genreColor.value = "#e66465";       // se clicco su reset reimposto anche il colore del genere a quello di default, ovvero: #e66465
    genreDescription.value = "";
});
/* -------------------------------- Fine codice pulsante reset del form Create/Edit Genre (generi): -------------------------------- */






/* ----------- Codice della select per la selezione del regista dal form Create/Edit Movies (Creazione/modifica di un film): ----------- */
document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('director_id');

    select.addEventListener('change', function () {
        // Se viene selezionata una option nella select:
        if (this.value) {
            // Allora cambia il colore di sfondo e del testo
            this.style.backgroundColor = '#d46770ba';   // Rosso quasi trasparente
            this.style.color = 'black';
        } else {
            // ALtrimenti se seleziono il campo di default: -- Nessun regista selezionato -- riporto il colore di sfondo e del testo all'impostazione iniziale del non selezionato:
            this.style.backgroundColor = '#F8FAFC'; // Grigio chiaro
            this.style.color = 'black';
        }
    });

    // Impostazioni dello stile iniziale al caricamento della pagina
    if (!select.value) {
        select.style.backgroundColor = 'white';
        select.style.color = 'black';
    }
});
/* ----------- Fine codice della select per la selezione del regista dal form Create/Edit Movies (Creazione/modifica di un film): ----------- */