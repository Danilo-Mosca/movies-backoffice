@props([
    'model' => null,
    'modelDirectors',
    'modelGenres',
    'modelActors',
    'action',
    'method' => 'POST',
    'buttonText' => 'Salva',
    //Props per mostrare i campi dinamici:
    // Props della tabella films:
    'showTitle' => false,
    'showDescription' => false,
    'showImage' => false,
    'showGenres' => false,
    'showUpdateGenres' => false,
    'showReleaseYear' => false,
    'showDuration' => false,
    'showActors' => false,
    'showUpdateActors' => false,
    'showRating' => false,
    'showNationality' => false,
    'showDirectors' => false,
    // Props della tabella directors:
    'showDirectorFirstName' => false,
    'showDirectorLastName' => false,
    'showDirectorBirthDate' => false,
    'showDirectorNationality' => false,
    // Props della tabella actors:
    'showActorFirstName' => false,
    'showActorLastName' => false,
    'showActorBirthDate' => false,
    'showActorNationality' => false,
    // Props dei generi:
    'showGenreName' => false,
    'showGenreColor' => false,
    'showGenreDescription' => false,
])

{{-- ------------------- Sezione form: ------------------- --}}
<section>


    {{-- Messaggio di errore per tutti i campi se il controllo non ha portato a validazione: --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- Fine messaggio di errore per tutti i campi se il controllo non ha portato a validazione: --}}



    <form action="{{ $action }}" method="POST"
    {{-- Se la variabile $showImage non è false, allora sono nella create/edit di film e quindi per caricare l'immagine devo aggiungere l'enctype: --}}
    @if ($showImage) enctype="multipart/form-data" @endif
    novalidate>
        {{-- Inserisco il token che verifica che la chiamata avviene tramite un form del sito: --}}
        @csrf

        {{-- Prima verifico quale metodo http (POST o PUT o PATHC) è stato passato alla variabile $method. la funzione strtoupper() trasforma tutta la stringa in maiuscolo: --}}
        @if (strtoupper($method) !== 'POST')
            {{-- Aggiungiamo all'interno del form il metodo http da passare (PUT o PATCH), perchè di default dal form possiamo passare solo get e post: --}}
            @method('PUT')
        @endif



        {{-- IMPORTANTE: AD OGNI VALORE PRESENTE NELL'ATTRIBUTO "value" controllo se esiste il model con isset().
        Siccome nella "edit" ho bisogno del model, ma nella "create" non ho bisogno del model, controllo la sua esistenza, 
        se non esiste allora al value non passo nulla. Per verificare questo utilizzo l'operatore ternario.
        Esempio:
        value nella input type="text":
        Nella "create" dovrebbe essere:         value="{{ old('title') }}"
        Mentre nella "edit" dovrebbe essere:    value="{{ old('title', $movie->title) }}"
        PER INTEGRARE ENTRAMBI NEL COMPONENTE INSERISCO L'OPERATORE TERNARIO CON LA SEGUENTE CONDIZIONE: se esiste il model allora lo mostro, altrimenti non visualizzo nulla con ''
        value="{{ old('title', isset($model->title) ? $model->title : '') }}"
--}}


        {{-- ------------------------------------- SEZIONE DEL FORM PER L'AGGIUNTA E LA MODIFICA DEI FILM: ------------------------------------- --}}

        {{-- Verifico se $showTitle risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showTitle)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="title">* Titolo del film:</label>
                <input type="text" name="title" id="title" class="input-layout"
                    placeholder="Inserisci il titolo del film"
                    value="{{ old('title', isset($model->title) ? $model->title : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('title')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif


        {{-- Input textarea descrizione film --}}
        {{-- Verifico se $showDescription risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showDescription)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="description">* Descrizione:</label>
                <textarea name="description" id="description" id="description" rows="5" class="input-layout"
                    placeholder="Inserisci la descrizione del film">{{ old('description', isset($model->description) ? $model->description : '') }}</textarea>

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('description')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif
        {{-- Fine input textarea descrizione film --}}


        {{-- Input file del film --}}
        {{-- Verifico se $showImage risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showImage)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="poster">Inserisci un'immagine:</label>
                <input type="file" name="poster" id="poster" class="input-layout"
                    value="{{ old('poster', isset($model->poster) ? $model->poster : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('poster')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif
        {{-- Fine input file del film --}}





        {{-- ------------------------------------------ SEZIONE INSERIMENTO E MODIFICA GENERI ------------------------------------------ --}}
        {{-- Input checkbox aggiungi attori film --}}
        {{-- Verifico se $showActors risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showActors)
            <div class="form-control">
                <label class="mb-3">Seleziona il/i generi per il film (se presente nella lista):</label>
                <div class=" mb-3 d-flex flex-wrap input-layout">
                    @foreach ($modelGenres as $genre)
                        <div class="me-3">
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                id="genre-{{ $genre->id }}">
                            <label for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                        </div>
                    @endforeach
                </div>

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('genres')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif
        {{-- Fine input checkbox aggiungi attori film --}}


        {{-- Input checkbox modifica attori film --}}
        {{-- Verifico se $showUpdateActors risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showUpdateActors)
            <div class="form-control">
                <label class="mb-3">Seleziona il/i generi per il film (se presente nella lista):</label>
                <div class=" mb-3 d-flex flex-wrap input-layout">
                    @foreach ($modelGenres as $genre)
                        <div class="me-3">
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                id="genre-{{ $genre->id }}"
                                {{ $model->genres->contains($genre->id) ? 'checked' : '' }}>
                            {{-- Nella riga di sopra verifico con l'operatore ternario se quel valore è presente, se così lo spunto come checked: --}}
                            <label for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                        </div>
                    @endforeach
                </div>

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('genres')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif
        {{-- Fine input checkbox modifica attori film --}}
        {{-- ------------------------------------------ FINE SEZIONE INSERIMENTO E MODIFICA GENERI ------------------------------------------ --}}






        {{-- Input number anno di rilascio film --}}
        {{-- Verifico se $showReleaseYear risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showReleaseYear)
            <div class="form-control mb-3 input-wrapper d-flex flex-column">
                <label for="release_year">* Anno di uscita:</label>
                <input type="number" id="release_year" name="release_year" placeholder="Esempio: 2025"
                    class="input-layout"
                    value="{{ old('release_year', isset($model->release_year) ? $model->release_year : '') }}" />

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('release_year')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif
        {{-- Fine input number anno di rilascio film --}}


        {{-- Input number durata film --}}
        {{-- Verifico se $showDuration risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showDuration)
            <div class="form-control mb-3 input-wrapper d-flex flex-column">
                <label for="duration">* Durata (in minuti):</label>
                <input type="number" id="duration" name="duration" min="1" max="255" class="input-layout"
                    placeholder="Esempio: 120"
                    value="{{ old('duration', isset($model->duration) ? $model->duration : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('duration')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif
        {{-- Fine input number durata film --}}





        {{-- ------------------------------------------ SEZIONE INSERIMENTO E MODIFICA ATTORI ------------------------------------------ --}}
        {{-- Input checkbox aggiungi genere film --}}
        {{-- Verifico se $showGenres risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showGenres)
            <div class="form-control">
                <label class="mb-3">Selezioni gli attori presenti nel film (se il lista):</label>
                <div class=" mb-3 d-flex flex-wrap input-layout">
                    @foreach ($modelActors as $actor)
                        <div class="me-3">
                            <input type="checkbox" name="actors[]" value="{{ $actor->id }}"
                                id="actor-{{ $actor->id }}">
                            <label for="actor-{{ $actor->id }}">{{ $actor->getFullNameAttribute() }}</label>
                        </div>
                    @endforeach
                </div>

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('actors')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif
        {{-- Fine input checkbox aggiungi genere film --}}


        {{-- Input checkbox modifica genere film --}}
        {{-- Verifico se $showUpdateGenres risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showUpdateGenres)
            <div class="form-control">
                <label class="mb-3">Selezioni gli attori presenti nel film (se il lista):</label>
                <div class=" mb-3 d-flex flex-wrap input-layout">
                    @foreach ($modelActors as $actor)
                        <div class="me-3">
                            <input type="checkbox" name="actors[]" value="{{ $actor->id }}"
                                id="actor-{{ $actor->id }}"
                                {{ $model->actors->contains($actor->id) ? 'checked' : '' }}>
                            {{-- Nella riga di sopra verifico con l'operatore ternario se quel valore è presente, se così lo spunto come checked: --}}
                            <label for="actor-{{ $actor->id }}">{{ $actor->getFullNameAttribute() }}</label>
                        </div>
                    @endforeach
                </div>

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('actors')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif
        {{-- Fine input checkbox modifica genere film --}}
        {{-- ------------------------------------------FINE SEZIONE INSERIMENTO E MODIFICA ATTORI ------------------------------------------ --}}






        {{-- Input radio per i rating --}}
        {{-- Verifico se $showRating risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showRating)
            <div class="form-control">
                <label for="star">Inserisci un voto:</label><br>
                <div class="star-rating mt-3 mb-3">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                            {{ old('rating', isset($model->rating) ? $model->rating : '') == $i ? 'checked' : '' }}
                            data-stato-selezionato="false">
                        <label for="star{{ $i }}" title="{{ $i }} stelle"
                            class="bi bi-star-fill custom-star-label"></label>
                    @endfor
                </div>
            </div>
        @endif
        {{-- Input radio per i rating --}}


        {{-- Input del poster... che per ora lascio da parte --}}
        <div class="form-control mb-3 d-flex flex-column input-wrapper">
            <p>Input poster per ora non utilizzare</p>
        </div>
        {{-- Fine Input del poster... che per ora lascio da parte --}}


        {{-- Input text per l'inserimento della nazionalità --}}
        {{-- Verifico se $showNationality risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showNationality)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="nationality">Nazionalità del film:</label>
                <input type="text" name="nationality" id="nationality" class="input-layout"
                    placeholder="Inserisci la nazionalità del film"
                    value="{{ old('nationality', isset($model->nationality) ? $model->nationality : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('nationality')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif
        {{-- Fine input text per l'inserimento della nazionalità --}}


        {{-- Input radio per il regista --}}
        {{-- Verifico se $showDirectors risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showDirectors)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="director_id">Seleziona il regista (se presente):</label>
                <select name="director_id" id="director_id" class="input-layout">

                    <option value="null" selected>-- Nessun regista selezionato --</option>

                    @foreach ($modelDirectors as $director)
                        <option value="{{ $director->id }}"
                            {{ old('director_id', isset($model->director_id) ? ($model->director_id == $director->id ? 'selected' : '') : '') }}>
                            {{ $director->getFullNameAttribute() }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        {{-- Fine Input radio per il regista --}}

        {{-- ------------------------------------- SEZIONE DEL FORM PER L'AGGIUNTA E LA MODIFICA DEI FILM: ------------------------------------- --}}





        {{-- ------------------------------------- SEZIONE DEL FORM PER L'AGGIUNTA E LA MODIFICA DEI REGISTI: ------------------------------------- --}}

        {{-- Verifico se $showDirectorFirstName risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showDirectorFirstName)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="first_name">* Nome del regista:</label>
                <input type="text" name="first_name" id="first_name" class="input-layout"
                    placeholder="Inserisci il nome del regista"
                    value="{{ old('first_name', isset($model->first_name) ? $model->first_name : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('first_name')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif


        {{-- Verifico se $showDirectorLastName risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showDirectorLastName)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="last_name">* Cognome del regista:</label>
                <input type="text" name="last_name" id="last_name" class="input-layout"
                    placeholder="Inserisci il cognome del regista"
                    value="{{ old('last_name', isset($model->last_name) ? $model->last_name : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('last_name')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif


        {{-- Verifico se $showDirectorBirthDate risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showDirectorBirthDate)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="birth_date">Data di nascita del regista:</label>
                <input type="date" name="birth_date" id="birth_date" class="input-layout"
                    value="{{ old('birth_date', isset($model->birth_date) ? $model->birth_date : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('birth_date')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif


        {{-- Verifico se $showDirectorNationality risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showDirectorNationality)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="director_nationality">Nazionalità del regista:</label>
                <input type="text" name="director_nationality" id="director_nationality" class="input-layout"
                    placeholder="Inserisci la nazionalità del regista"
                    value="{{ old('director_nationality', isset($model->director_nationality) ? $model->director_nationality : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('director_nationality')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif

        {{-- ------------------------------------- FINE SEZIONE DEL FORM PER L'AGGIUNTA E LA MODIFICA DEI REGISTI: ------------------------------------- --}}





        {{-- ------------------------------------- SEZIONE DEL FORM PER L'AGGIUNTA E LA MODIFICA DEGLI ATTORI: ------------------------------------- --}}

        {{-- Verifico se $showActorFirstName risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showActorFirstName)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="first_name">* Nome dell'attore:</label>
                <input type="text" name="first_name" id="first_name" class="input-layout"
                    placeholder="Inserisci il nome dell'attore"
                    value="{{ old('first_name', isset($model->first_name) ? $model->first_name : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('first_name')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif


        {{-- Verifico se $showActorLastName risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showActorLastName)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="last_name">* Cognome dell'attore:</label>
                <input type="text" name="last_name" id="last_name" class="input-layout"
                    placeholder="Inserisci il cognome dell'attore"
                    value="{{ old('last_name', isset($model->last_name) ? $model->last_name : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('last_name')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif


        {{-- Verifico se $showActorBirthDate risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showActorBirthDate)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="birth_date">Data di nascita dell'attore:</label>
                <input type="date" name="birth_date" id="birth_date" class="input-layout"
                    value="{{ old('birth_date', isset($model->birth_date) ? $model->birth_date : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('birth_date')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif


        {{-- Verifico se $showActorNationality risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showActorNationality)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="actor_nationality">Nazionalità del regista:</label>
                <input type="text" name="actor_nationality" id="actor_nationality" class="input-layout"
                    placeholder="Inserisci la nazionalità dell'attore"
                    value="{{ old('actor_nationality', isset($model->actor_nationality) ? $model->actor_nationality : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('actor_nationality')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif

        {{-- ------------------------------------- FINE SEZIONE DEL FORM PER L'AGGIUNTA E LA MODIFICA DEGLI ATTORI: ------------------------------------- --}}





        {{-- ------------------------------------- SEZIONE DEL FORM PER L'AGGIUNTA E LA MODIFICA DEI GENERI: ------------------------------------- --}}

        {{-- Verifico se $showGenreName risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showGenreName)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="name">* Nome del nuovo genere:</label>
                <input type="text" name="name" id="name" class="input-layout"
                    placeholder="Inserisci il nome del nuovo genere"
                    value="{{ old('name', isset($model->name) ? $model->name : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('name')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif


        {{-- Input radio per il colore del genere --}}
        {{-- Verifico se $showGenreColor risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showGenreColor)
            <div class="form-control mb-3 d-flex align-items-center column-gap-3 input-wrapper">
                <label for="color">* Scegli un colore da associare al genere:</label>
                {{-- Se nella pagina create, quando si vuole creare un nuovo genre, non viene specificato nessun colore, allora quello di default sarà #e66465 ovvero un rosa pallido: --}}
                <input type="color" name="color" id="color"
                    value="{{ old('color', isset($model->color) ? $model->color : '#e66465') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('color')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif
        {{-- Fine input radio per il colore del genere --}}


        {{-- Verifico se $showGenreDescription risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showGenreDescription)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="genre_description">Aggiungi una descrizione:</label>
                <textarea name="genre_description" id="genre_description" id="genre_description" rows="5"
                    class="input-layout" placeholder="Inserisci la descrizione del film">{{ old('genre_description', isset($model->genre_description) ? $model->genre_description : '') }}</textarea>

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('genre_description')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif

        {{-- ------------------------------------- FINE SEZIONE DEL FORM PER L'AGGIUNTA E LA MODIFICA DEI GENERI: ------------------------------------- --}}



        <div class="d-flex justify-content-between">
            <input type="submit" value="{{ $buttonText }}" class="mt-3">
            {{-- Oppure:
                    <button>Salva</button> --}}

            <button class="mt-3 mx-3" id="button-id-reset">RESET</button>
        </div>
    </form>
    <hr class="mt-5" />
</section>
{{-- ------------------- Fine sezione ------------------- --}}
