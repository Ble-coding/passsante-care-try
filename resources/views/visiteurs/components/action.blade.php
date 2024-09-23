<div class="d-flex justify-content-center">
    <a href="{{ route('assistants.visiteurs.edit', $row->id)  }}" title="{{__('messages.common.edit') }}"
       class="btn px-1 text-primary fs-3 ps-0">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    {{-- <a href="javascript:void(0)" title="{{__('messages.common.delete')}}" data-id="{{ $row->id }}" wire:key="{{$row->id }}"
       class="visiteur-delete-btn btn px-1 text-danger fs-3 ps-0">
        <i class="fa-solid fa-trash"></i>
    </a> --}}

{{-- 
    <a href="javascript:void(0)" data-id="{{ $row->id }}" title="{{ __('messages.common.delete') }}"  data-bs-toggle="tooltip"
        data-bs-original-title="{{ __('messages.common.delete') }}"
        class="btn px-2 text-danger fs-2 patient-delete-btn">
         <i class="fa-solid fa-trash"></i>
     </a> --}}
</div>

