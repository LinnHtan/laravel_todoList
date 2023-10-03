@extends('master');

@section('content')
    <div class="container ">
        <div class="row mt-5">
            <div class="col-5 shadow-sm">
                <div class="p-2">
                    @if (session('insertSuccess'))
                        <div class="alert-message">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('insertSuccess') }}</strong> <button type="button" class="btn-close"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <form method="post" action="{{ route('create#post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="text-group mb-3">
                            <label for="">Post Title</label>
                            <input type="text" name="postTitle"
                                class="form-control @error('postTitle') is-invalid @enderror "
                                value="{{ old('postTitle') }}" placeholder="Enter post title">
                            @error('postTitle')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group">
                            <label for="">Post Description</label>
                            <textarea name="postDescription" class="form-control @error('postDescription') is-invalid @enderror"
                                placeholder="Enter post description">{{ old('postDescription') }}</textarea>
                            @error('postDescription')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Image</label>
                            <input type="file" name="postImage"
                                class="form-control @error('postImage') is-invalid @enderror "
                                value="{{ old('postImage') }}">
                            @error('postImage')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Price</label>
                            <input type="number" name="postPrice"
                                class="form-control @error('postPrice') is-invalid @enderror" value="{{ old('postPrice') }}"
                                placeholder="Enter post price">
                            @error('postPrice')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group mb-3">
                            <label for="">Address</label>
                            <input type="text" name="postAddress"
                                class="form-control @error('postAddress') is-invalid @enderror"
                                value="{{ old('postAddress') }}" placeholder="Enter post Address">
                            @error('postAddress')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-group">
                            <label for="">Rating</label>
                            <input type="number" name="postRating"
                                class="form-control @error('postRating') is-invalid @enderror"
                                value="{{ old('postRating') }}" placeholder="Enter post rating">
                            @error('postRating')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mt-3 float-end">
                            <input type="submit" value="Create" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-7 ">
                <div class="row">
                    <div class="col-5">
                        <h3> Total - {{ $posts->total() }}</h3>
                    </div>
                    <div class="col-5 offset-2">
                        <form action="{{ route('create#postPage') }}" method="get">
                            <div class="row">
                                <input type="text" name="searchKey" value="{{ request('searchKey') }}"
                                    class="form-control col" placeholder="Enter search key...">
                                <button type="submit" class=" ms-1 col-2 btn btn-outline-danger">
                                    <i class="fa-solid fa-magnifying-glass"></i></button>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="data-container shadow-sm  mt-3">
                    @if (session('deleteSuccess'))
                        <div class="alert-message">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleteSuccess') }}</strong> <button type="button" class="btn-close"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('createSuccess'))
                        <div class="alert-message">
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong>{{ session('createSuccess') }}</strong> <button type="button" class="btn-close"
                                    data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (count($posts) != 0)
                        @foreach ($posts as $p)
                            <div class="row">
                                <div class="col-2">
                                   <div class="">
                                    @if ($p->image == null)
                                    <img class="img-thumbnail shadow-sm" src="{{ asset('404.png') }}" alt="">
                                    @else
                                    <img  class=" img-thumbnail shadow-sm" src="{{ asset('storage/'. $p->image) }}" alt="Image">
                                    @endif
                                   </div>


                                </div>
                                <div class="col-10">
                                    <div class=" p-2 shadow-sm mb-3">
                                        <div class="d-flex">
                                            <div class="col-8">
                                                <h5>{{ $p['title'] }}</h5>
                                            </div>
                                            <div class="col-4">
                                                <h5>{{ $p->created_at->format('d-M-y | n:i:A') }}</h5>
                                            </div>
                                        </div>
                                        <p class="text-muted">{{ Str::words($p['description'], 10, '...') }}</p>
                                        <span>
                                            <i
                                                class="fa-solid text-primary fa-money-bill-1 me-2"></i><small>{{ $p['price'] }}Kyats</small>
                                        </span> |
                                        <span>
                                            <i
                                                class="fa-solid text-danger me-2 fa-location-dot"></i><small>{{ $p['address'] }}</small>
                                        </span> |
                                        <span>
                                            <i
                                                class="fa-solid text-warning me-2 fa-star"></i><small>{{ $p['rating'] }}</small>
                                        </span>
                                        <div class="text-end">
                                            <a href="{{ route('delete#post', $p['id']) }}">
                                                <button class="btn btn-sm btn-danger me-2"><i
                                                        class="fa-solid fa-trash-can ">ဖျက်ရန်</i></button>
                                            </a>
                                            <a href="{{ route('update#postPage', $p['id']) }}">
                                                <button class="btn btn-sm btn-info"><i
                                                        class="fa-solid fa-circle-info ">အပြည့်အစုံဖတ်ရန်</i></button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if (count($posts) == 0)
                        <h2 class="bg-danger text-center text-white">There is no data</h2>
                    @endif

                </div>
                <div class="float-end mt-3 shadow-sm">
                    {{ $posts->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection()
