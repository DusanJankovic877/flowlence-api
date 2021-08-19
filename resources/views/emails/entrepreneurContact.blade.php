@component('mail::message')
<h1>{{request('entrepreneur')}}</h1>
<table class="mail-table">
<tr>
<td>Naziv</td>
<td>Opcija</td>
<td>Cena</td>
</tr>
<tbody>
<tr>
<td>Izabrane Usluge</td>
<td>@foreach (request('checkedServices') as $checkedService){{ $checkedService['title'] }} @endforeach</td>
<td>{{ request('checkedServicesSum') }} &euro;</td> 
</tr>
<tr>
<td>Broj lica za zaposlenje</td>
<td>{{ request('people.title') }}</td>
<td>{{ request('people.price') }} &euro;</td> 
</tr>
<tr>
<td>Prihod koji se očekuje</td>
<td>{{ request('income.title') }}</td>
<td>{{ request('income.price') }} &euro;</td> 
</tr>
<tr>
<td>Pausalno Oporezovanje</td>
<td>{{ request('incomeExtra.title') }}</td>
<td>{{ request('incomeExtra.price') }} &euro;</td> 
</tr>
<tr>
<td>Pdv</td>
<td>{{ request('pdv.title') }}</td>
<td>{{ request('pdv.price') }} &euro;</td> 
</tr>
<tr>
<td>Platni promet</td>
<td>{{ request('payment.title') }}</td>
<td>{{ request('payment.price') }} &euro;</td> 
</tr>
<tr>
<td>Vrsta klijenta</td>
<td>{{ request('client.title') }}</td>
<td>{{ request('client.price') }} &euro;</td> 
</tr>
<tr>
<td>Fiskalna kasa</td>
<td>{{ request('cashRegister.title') }}</td>
<td>{{ request('cashRegister.price') }} &euro;</td> 
</tr>
<tr>
<td>Elektronsko bankarstvo</td>
<td>{{ request('eBanking.title') }}</td>
<td>{{ request('eBanking.price') }} &euro;</td> 
</tr>
<tr>
<td>Dodatni komentar</td>
<td>{{ request('comment') }}</td>
</tr>
<tr>
<td>Email</td>
<td>{{ request('email') }}</td>
</tr>
<tr>
<td>Ukpna cena </td>
<td></td>
<td class="last-td">{{ request('totalSum') }} &euro;</td>
</tr>
</tbody>
</table>



    {{-- ### Hvala,<br>
### {{ config('app.name') }} --}}
@endcomponent
<style>
    .mail-table {
    border-collapse: collapse;
    /* border-spacing: 0; */
    border:1px solid #000000;

}

.mail-table th{
    border:1px solid #000000;
}

.mail-table td{
    border:1px solid #000000;
    padding: 3px 10px;
}
.last-td{
    width: 70px;
}
</style>