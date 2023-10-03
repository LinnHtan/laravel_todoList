@extends('master');

@section('content')
    <div class="container">
        <div class="row shadow-sm  offset-3 col-6 mt-5">
            <div class="mb-4 ">
                <a href="{{ route('post#home') }}" class="text-decoration-none text-dark">
                    <i class="fa-solid fa-arrow-left me-2"></i>back
                </a>
            </div>
            <div class="shadow-sm ">
                <h3>{{ $post['title'] }}</h3>
                <div class="d-flex">
                    <div class="btn btn-sm bg-dark text-white me-2 my-3"> <i
                            class="fa-solid text-primary fa-money-bill-1 me-2"></i><small>{{ $post['price'] }}Kyats</small>
                    </div>
                    <div class="btn btn-sm bg-dark text-white me-2 my-3"><i
                            class="fa-solid text-danger me-2 fa-location-dot"></i><small>{{ $post['address'] }}</small>
                    </div>
                    <div class="btn btn-sm bg-dark text-white me-2 my-3"><i
                            class="fa-solid text-warning me-2 fa-star"></i><small>{{ $post['rating'] }}</small></div>

                    <div class="btn btn-sm bg-dark text-white me-2 my-3">
                        <i
                            class="fa-regular text-info me-2 fa-calendar-days"></i><small>{{ $post->created_at->format('j-F-Y') }}</small>
                    </div>
                    <div class="btn btn-sm bg-dark text-white me-2 my-3">
                        <i
                            class="fa-solid text-primary me-2 fa-clock"></i><small>{{ $post->created_at->format('h-m-s-A') }}</small>
                    </div>
                </div>

                <p class="text-muted">{{ $post['description'] }}</p>
                <div class="">
                    @if ($post->image == null)
                        <img class="img-thumbnail shadow-sm" src="{{ asset('404.png') }}" alt="">
                    @else
                        <img class="img-thumbnail shadow-sm" src="{{ asset('storage/' . $post->image) }}" alt="">
                    @endif
                </div>

            </div>
            <div class="row">
                <div class=" my-4 offset-10 col-2 shadow-sm ">
                    <a href="{{ route('edit#post', $post['id']) }}">
                        <button class="btn btn-dark">Edit</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
