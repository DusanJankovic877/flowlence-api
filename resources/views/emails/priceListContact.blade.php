@component('mail::message')
<h1>{{request('typeOfFrom')}}</h1>
<table class="mail-table">
<tr>
<td>Naziv</td>
<td>Opcija</td>
<td>Cena</td>
</tr>
<tbody>
<tr>
<td>Izabrane Usluge</td>
<td>@foreach (request('firstQuestion') as $checkedService){{ $checkedService['option_text'] }} @endforeach</td>
<td>{{ request('firstQSum') }} &euro;</td> 
</tr>
<tr>
<td>Broj lica za zaposlenje</td>
<td>{{ request('secondQuestion.option_text') }}</td>
<td>{{ request('secondQuestion.price') }} &euro;</td> 
</tr>
<tr>
<td>Prihod koji se očekuje</td>
<td>{{ request('thirdQuestion.option_text') }}</td>
<td>{{ request('thirdQuestion.price') }} &euro;</td> 
</tr>
<tr>
<td>Pausalno Oporezovanje</td>
<td>{{ request('fourthQuestion.option_text') }}</td>
<td>{{ request('fourthQuestion.price') }} &euro;</td> 
</tr>
<tr>
<td>Pdv</td>
<td>{{ request('fifthQuestion.option_text') }}</td>
<td>{{ request('fifthQuestion.price') }} &euro;</td> 
</tr>
<tr>
<td>Platni promet</td>
<td>{{ request('sixthQuestion.option_text') }}</td>
<td>{{ request('sixthQuestion.price') }} &euro;</td> 
</tr>
<tr>
<td>Vrsta klijenta</td>
<td>{{ request('seventhQuestion.option_text') }}</td>
<td>{{ request('seventhQuestion.price') }} &euro;</td> 
</tr>
<tr>
<td>Fiskalna kasa</td>
<td>{{ request('eighthQuestion.option_text') }}</td>
<td>{{ request('eighthQuestion.price') }} &euro;</td> 
</tr>
<tr>
<td>Elektronsko bankarstvo</td>
<td>{{ request('ninthQuestion.option_text') }}</td>
<td>{{ request('ninthQuestion.price') }} &euro;</td> 
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
<td class="last-td">{{ request('totalPrice') }} &euro;</td>
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