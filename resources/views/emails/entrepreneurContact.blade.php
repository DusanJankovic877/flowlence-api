@component('mail::message')


# Izabrane usluge: @foreach (request('checkedServices') as $checkedService) {{ $checkedService['title'] .  ", " . $checkedService['price']}} &euro; @endforeach <br>
# Broj lica za zaposlenje: {{request('people.title') . ", " . request('people.price')}} &euro;

# Prihod koji se očekuje: {{request('income.title') . ", " . request('income.price')}} &euro;
# Pausalno Oporezovanje: {{request('incomeExtra.title') . ", " . request('incomeExtra.price')}} &euro;
# Pdv: {{request('pdv.title') . ", " . request('pdv.price')}} &euro;
# Platni promet: {{request('payment.title') . ", " . request('payment.price')}} &euro;
# Vrsta klijenta: {{request('client.title') . ", " . request('client.price')}} &euro;
# Fiskalna kasa: {{request('cashRegister.title') . ", " . request('cashRegister.price')}} &euro;
# Elektronsko bankarstvo: {{request('eBanking.title') . ", " . request('eBanking.price')}} &euro;
# Dodatni komentar: {{request('comment')}}
# Email: {{request('email')}}
# Ukupna cena usluga: {{request('totalSum'). ' '}} &euro;


{{-- ### Hvala,<br>
### {{ config('app.name') }} --}}
@endcomponent