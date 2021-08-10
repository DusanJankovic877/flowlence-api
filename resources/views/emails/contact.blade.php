@component('mail::message')
# Mail poslao {{request('name')}}




{{request('message')}}


### Hvala,<br>
### {{ config('app.name') }}
@endcomponent