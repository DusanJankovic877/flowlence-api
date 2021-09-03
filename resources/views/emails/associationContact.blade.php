@component('mail::message')
<h1>{{request('association')}}</h1>
<table class="mail-table">
<tr>
<td>Naziv</td>
<td>Opcija</td>
<td>Cena</td>
</tr>
<tbody>
<tr>
<td>Osnivači udruženja</td>
<td>{{ request('assocFounder.option_text') }} </td>
<td>{{ request('assocFounder.price') }} &euro;</td> 
</tr>
<tr>
<td>Osnivači udruženja</td>
<td>{{ request('assocFounder2.option_text') }}</td>
<td>{{ request('assocFounder2.price') }} &euro;</td> 
</tr>
<tr>
<td>Ostvarivanje Prihoda na tržištu, izdavanje faktura</td>
<td>{{ request('registration.option_text') }}</td>
<td>{{ request('registration.price') }} &euro;</td> 
</tr>
<tr>
<td>Prihod koji se očekuje</td>
<td>{{ request('income.option_text') }}</td>
<td>{{ request('income.price') }} &euro;</td> 
</tr>
<tr>
<td>Broj lica za zaposlenje</td>
<td>{{ request('person.option_text') }}</td>
<td>{{ request('person.price') }} &euro;</td> 
</tr>
<tr>
<td>Pdv</td>
<td>{{ request('pdv.option_text') }}</td>
<td>{{ request('pdv.price') }} &euro;</td> 
</tr>
<tr>
<td>Platni promet</td>
<td>{{ request('payment.option_text') }}</td>
<td>{{ request('payment.price') }} &euro;</td> 
</tr>
<tr>
<td>Fiskalna kasa</td>
<td>{{ request('cashRegister.option_text') }}</td>
<td>{{ request('cashRegister.price') }} &euro;</td> 
</tr>
<tr>
<td>Elektronsko bankarstvo</td>
<td>{{ request('eBanking.option_text') }}</td>
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