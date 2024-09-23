<div class="d-flex align-items-center">
    <a href="javascript:void(0)">
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->assistant->user->profile_image}}" alt="user" class="user-img">
        </div>
    </a>
    <div class="d-flex flex-column">
        <div class="d-inline-block align-top">
            <div class="d-inline-block align-self-center d-flex">
                <a href="{{route('assistants.show', $row->assistant_id)}}" class="mb-1 text-decoration-none fs-6">
                    {{$row->assistant->user->full_name}}
                </a>
                <div class="mb-1 star-ratings d-flex align-self-center ms-2">
                    @if($row->assistant->reviews_assistants->avg('rating') != 0)
                        @php
                            $rating = $row->assistant->reviews_assistants>avg('rating');
                        @endphp
                        @foreach(range(1, 5) as $i)
                            <div class="avg-review-star-div d-flex align-self-center mb-1">
                                @if($rating > 0)
                                    @if($rating > 0.5)
                                        <i class="fas fa-star review-star"></i>
                                    @else
                                        <i class="fas fa-star-half-alt review-star"></i>
                                    @endif
                                @else
                                    <i class="far fa-star review-star"></i>
                                @endif
                            </div>
                            @php $rating--; @endphp
                        @endforeach
                    @else
                        @foreach(range(1, 5) as $i)
                            <i class="far fa-star review-star"></i>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <span class="fs-6">{{$row->assistant->user->email}}</span>
    </div>

</div>
