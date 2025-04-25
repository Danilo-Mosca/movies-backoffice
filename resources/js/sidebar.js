/* IMPORTANTE: la prima riga di codice:
document.addEventListener('DOMContentLoaded', () => {
Aspetta che il DOM (Document Object Model) sia completamente caricato prima di eseguire il codice al suo interno.
Se non avessi inserito questa istruzione non potrei selezionare lo pseudoelemento ::after perchè questo non è un vero nodo DOM, quindi non puoi selezionarlo direttamente con JavaScript puro (tipo document.querySelector('.dropdown-toggle::after') — non funziona).
*/

document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.dropdown-toggle');

    toggle.addEventListener('click', () => {
        toggle.classList.toggle('rotated');     // uso il metodo toggle che attiva e disattiva la classe .rotated
    });
});



document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.dropdown-toggle-admin');

    toggle.addEventListener('click', () => {
        toggle.classList.toggle('rotated');     // uso il metodo toggle che attiva e disattiva la classe .rotated
    });
});



document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.dropdown-toggle-mobile');

    toggle.addEventListener('click', () => {
        toggle.classList.toggle('rotated');     // uso il metodo toggle che attiva e disattiva la classe .rotated
    });
});