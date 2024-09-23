<a type="button" class="btn btn-primary ms-auto"
   href="{{ getLogInUser()->hasRole('doctor') ? 
   route('doctors.visits.create') : //creation de visite DOCTEUR
   {{-- ou creation de visite administrateur --}}
   route('visits.create') }}"> 
    {{__('messages.visit.add_visit')}}
</a>


