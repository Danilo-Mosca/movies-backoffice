@php
    $passengers = [
        [
            'id' => 1,
            'passengerName' => 'Freddie Mercury',
            'isVegetarianOrVegan' => false,
            'connectedFlights' => 2,
        ],
        [
            'id' => 2,
            'passengerName' => 'Amy Winehouse',
            'isVegetarianOrVegan' => true,
            'connectedFlights' => 4,
        ],
        [
            'id' => 3,
            'passengerName' => 'Kurt Cobain',
            'isVegetarianOrVegan' => true,
            'connectedFlights' => 3,
        ],
        [
            'id' => 3,
            'passengerName' => 'Michael Jackson',
            'isVegetarianOrVegan' => true,
            'connectedFlights' => 1,
        ],
    ];
@endphp

{{-- Primo esercizio: --}}
@php
    $filtrata = [];
@endphp
@foreach ($passengers as $passenger)
    @foreach ($passenger as $key => $value)
        @if ($key == 'passengerName')
            @php
                $filtrata[] = $value;
            @endphp
        @endif
    @endforeach
@endforeach

@dump($filtrata)

{{-- Secondo esercizio: --}}
@php
    $filtrata = [];
@endphp
@foreach ($passengers as $passenger)

        @if ($passenger["isVegetarianOrVegan"])
            @php
                $filtrata[] = $passenger["passengerName"]
            @endphp
        @endif
@endforeach

@dd($filtrata)
