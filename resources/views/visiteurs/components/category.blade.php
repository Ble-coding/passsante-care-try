

@if ($row-> categorie === 'A')
<span class="fs-4 text-gray-800">{{ __('messages.visitor.adulte') }}</span>
@else
<span class="fs-4 text-gray-800">{{ __('messages.visitor.enfant') }}</span>
@endif