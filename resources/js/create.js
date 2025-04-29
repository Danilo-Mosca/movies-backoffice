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
