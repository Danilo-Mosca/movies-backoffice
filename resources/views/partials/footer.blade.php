{{-- Styles: istruzione che permette a Laravel di cercare le risorse per Bootstrap ed SCSS: 
      In questo caso importo il file "footer.scss" (nella cartella "partials") che contiene il CSS specifico per il footer: --}}
@vite(['resources/sass/partials/footer.scss'])

<footer class="row py-4 mt-auto">

    <div class="col mb-2">
        <div class="footer-title mb-3 d-flex justify-content-center">About</div>
        <div class="d-flex justify-content-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</div>
        <div>
            <div class="d-flex justify-content-center pt-3">
                <i class="bi bi-youtube pe-3 social-icon-footer"></i>
                <i class="bi bi-instagram pe-3 social-icon-footer"></i>
                <i class="bi bi-twitter-x pe-3 social-icon-footer"></i>
                <i class="bi bi-facebook social-icon-footer"></i>
            </div>
        </div>
    </div>

    <div class="col mb-2">
        <div class="footer-title mb-3 d-flex justify-content-center">News film & update</div>
        <div class="d-flex justify-content-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</div>
    </div>

    <div class="col mb-2">
        <div class="footer-title mb-3 d-flex justify-content-center">Movies society</div>
        <div class="d-flex justify-content-center">
            {{-- Con l'istruzione di seguite: Vite::asset('percorso...') importo l'immagine affinché Blade la processi --}}
            <img src="{{ Vite::asset('resources/img/footer/clapperboard-footer.png') }}" alt="Logo clapperboard"
                class="footer-image">
        </div>
    </div>

</footer>
