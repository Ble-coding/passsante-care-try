@if ($row->matrimonial == 'C') 
<span class="fs-6">{{ __('messages.visitor.celibataire') }}</span>
@elseif ($row->matrimonial == 'Cb')
<span class="fs-6">{{ __('messages.visitor.concubinage') }}</span>
@elseif ($row->matrimonial == 'D')
<span class="fs-6">{{ __('messages.visitor.divorce') }}</span>
@elseif ($row->matrimonial == 'M')
<span class="fs-6">{{ __('messages.visitor.marie') }}</span>
@else
<span class="fs-6">{{ __('messages.visitor.veuve_veuf') }}</span>
@endif