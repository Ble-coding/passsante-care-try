


<div class="d-flex align-items-center">
    <a href="{{route('assistants.visiteurs.show',$row->id)}}">
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->profile_image}}" alt="" class="user-img">
            {{-- <img src="https://ui-avatars.com/api/?name={{ $row->nom}}" alt=""> --}}
        </div>
    </a>
    <div class="d-flex flex-column">
        <a href="{{ route('assistants.visiteurs.show',$row->id) }}" class="mb-1 text-decoration-none fs-6">
            {{$row->nom}}
        </a>
        <span class="fs-6">{{$row->prenom}}</span>
        {{-- <span class="fs-6">{{$row->gender}}</span> --}}
    </div>
</div>


