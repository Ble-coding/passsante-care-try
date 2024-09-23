


<a type="button" class="btn btn-primary ms-auto"
   href="{{ getLogInUser()->hasRole('assistant') ? 
   route('assistants.assistances.create') : 
   {{-- ou creation de visite administrateur --}}
   route('assistances.create') }}">
    {{__('messages.visit.add_assistance')}}
</a>


