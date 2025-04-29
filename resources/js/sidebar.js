/* IMPORTANTE: la prima riga di codice:
document.addEventListener('DOMContentLoaded', () => {
Aspetta che il DOM (Document Object Model) sia completamente caricato prima di eseguire il codice al suo interno.
Se non avessi inserito questa istruzione non potrei selezionare lo pseudoelemento ::after perchè questo non è un vero nodo DOM, quindi non puoi selezionarlo direttamente con JavaScript puro (tipo document.querySelector('.dropdown-toggle::after') — non funziona).
*/

// Evento per la sezione FILM del menu della sidebar in DESKTOP:
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.dropdown-toggle.film');

    toggle.addEventListener('click', () => {
        toggle.classList.toggle('rotated');     // uso il metodo toggle che attiva e disattiva la classe .rotated
    });
});
// Evento per la sezione FILM del menu della sidebar in MOBILE:
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.dropdown-toggle-mobile.film');

    toggle.addEventListener('click', () => {
        toggle.classList.toggle('rotated');     // uso il metodo toggle che attiva e disattiva la classe .rotated
    });
});

// Evento per la sezione REGISTI del menu della sidebar:
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.dropdown-toggle.registi');

    toggle.addEventListener('click', () => {
        toggle.classList.toggle('rotated');     // uso il metodo toggle che attiva e disattiva la classe .rotated
    });
});
// Evento per la sezione REGISTI del menu della sidebar in MOBILE:
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.dropdown-toggle-mobile.registi');

    toggle.addEventListener('click', () => {
        toggle.classList.toggle('rotated');     // uso il metodo toggle che attiva e disattiva la classe .rotated
    });
});


// Evento per la sezione amministratore (in basso) della sidebar:
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.dropdown-toggle-admin');

    toggle.addEventListener('click', () => {
        toggle.classList.toggle('rotated');     // uso il metodo toggle che attiva e disattiva la classe .rotated
    });
});