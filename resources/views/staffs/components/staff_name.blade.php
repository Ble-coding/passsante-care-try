

<div class="d-flex align-items-center">
    <a href="{{route('staffs.show',$row->id)}}">
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->profile_image }}" alt="user" class="user-img"> 
        </div>
    </a> 
    <div class="d-flex flex-column">
        <a href="{{ route('staffs.show',$row->id) }}" class="mb-1 text-decoration-none fs-6">
            {{$row->nom}}
        </a> 
        <span class="fs-6">{{$row->email}}</span>
    </div>
</div>
 