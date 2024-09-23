<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.visitor.birth_date')}}</label>
    @if (!empty($visiteur->date_de_naissance))
    <span class="fs-4 text-gray-800">{{ __('messages.visitor.birth_date_indication')}} {{ \Carbon\Carbon::parse($visiteur->date_de_naissance)->format('d-m-Y') }}</span>
@endif
</div>

<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.visitor.profession')  }}</label>
    <span class="fs-4 text-gray-800">{{ $visiteur->profession }}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.visitor.matrimonial')  }}</label>
    <span class="fs-4 text-gray-800">
        
        @if ($visiteur->matrimonial == 'C')
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.celibataire') }}</span>
    @elseif ($visiteur->matrimonial == 'Cb')
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.concubinage') }}</span>
    @elseif ($visiteur->matrimonial == 'D')
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.divorce') }}</span>
    @elseif ($visiteur->matrimonial == 'M')
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.marie') }}</span>
    @else
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.veuve_veuf') }}</span>
        @endif
        
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.visitor.shool_level')  }}</label>
    <span class="fs-4 text-gray-800">
        @if ($visiteur->niveau_scolaire == 1)
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.prescolaire') }}</span>
    @elseif ($visiteur->niveau_scolaire == 2)
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.primaire') }}</span>
    @elseif ($visiteur->niveau_scolaire == 3)
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.secondaire') }}</span>
    @elseif ($visiteur->niveau_scolaire == 4)
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.superieur') }}</span>
    @else
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.jamais_scolarise') }}</span>
        @endif

   
    
    </span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.visitor.home_address')  }}</label>
    <span class="fs-4 text-gray-800">{{ $visiteur->lieu_de_residence }}</span> 
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.visitor.cas_sociaux')  }}</label>
    <span class="fs-4 text-gray-800">
        @if ($visiteur->cas_social == 1)
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.oev') }}</span>
    @elseif ($visiteur->cas_social == 2)
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.chomeur') }}</span>
    @elseif ($visiteur->cas_social == 3)
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.pauvre') }}</span>
    @elseif ($visiteur->cas_social == 4)
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.autres') }}</span>
    {{-- @else
        <span class="fs-4 text-gray-800">Autre</span> Gérer d'autres cas si nécessaire --}}
    @endif
      
    
    </span>  
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.visitor.categorie') }}</label>
    @if ($visiteur->categorie == 'E')
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.enfant') }}</span>
    @elseif ($visiteur->categorie == 'A')
        <span class="fs-4 text-gray-800">{{ __('messages.visitor.adulte') }}</span>
    {{-- @else
        <span class="fs-4 text-gray-800">Autre</span> Gérer d'autres cas si nécessaire --}}
    @endif
</div>

<div class="col-md-6 d-flex flex-column mb-md-10 mb-5"> 
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.user.gender')  }}</label>
    <span
        class="fs-4 text-gray-800">{{ ($visiteur->gender == 1) ? __('messages.visitor.male') : __('messages.visitor.female') }}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.visitor.registered_on') }}</label>
    <span class="fs-4 text-gray-800">{{$visiteur->created_at->diffForHumans()}}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.visitor.last_updated') }}</label>
    <span class="fs-4 text-gray-800">{{$visiteur->updated_at->diffForHumans()}}</span>
</div>
