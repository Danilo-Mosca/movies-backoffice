@props([
    'model' => null,
    'action',
    'method' => 'POST',
    'buttonText' => 'Salva',
    //Props per mostrare i campi dinamici:
    'showTitle' => false,
    'showDescription' => false,
    'showReleaseYear' => false,
    'showDuration' => false,
    'showRating' => false,
    'showNationality' => false,
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



    <form action="{{ $action }}" method="POST">
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



        {{-- Verifico se $showTitle risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showTitle)
            <div class="form-control mb-3 d-flex flex-column input-wrapper">
                <label for="title">* Titolo del film:</label>
                <input type="text" name="title" id="title" class="input-layout"
                    placeholder="Inserisci il titolo del film" value="{{ old('title', isset($model->title) ? $model->title : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('title')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif

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

        {{-- Input number anno di rilascio film --}}
        {{-- Verifico se $showReleaseYear risulta "true", cioè se è stato passato dalla view allora stampo a schermo la input type specifica: --}}
        @if ($showReleaseYear)
            <div class="form-control mb-3 input-wrapper d-flex flex-column">
                <label for="release_year">* Anno di uscita:</label>
                <input type="number" id="release_year" name="release_year" placeholder="Esempio: 2025"
                    class="input-layout" value="{{ old('release_year', isset($model->release_year) ? $model->release_year : '') }}" />

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
                    placeholder="Esempio: 120" value="{{ old('duration', isset($model->duration) ? $model->duration : '') }}">

                {{-- Messaggio di errore per quel campo se il controllo non ha portato a validazione: --}}
                @error('duration')
                    <div class="text-danger pt-2">{{ $message }}</div>
                @enderror
            </div>
        @endif
        {{-- Fine input number durata film --}}


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


        {{-- Input radio per il regista --}}
        <div class="form-control mb-3 input-wrapper">
            <label for="director_id">Seleziona il regista (se presente): Anche questa per ora lasciarla da
                parte</label><br>
            {{-- @foreach ($directors as $type)
                        <input type="radio" id="director_id{{ $director }}" name="director_id"
                            value="{{ $i }}">
                        <label for="director_id{{ $director }}" title="{{ $director }} stelle">Nome regista</label>
                    @endforeach --}}
        </div>
        {{-- Fine Input radio per il regista --}}


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
