@extends('master');

@section('content')
    <div class="container">
        <div class="row shadow-sm  offset-3 col-6 mt-5">
            <div class="mb-4 ">
                <a href="{{ route('post#home') }}" class="text-decoration-none text-dark">
                    <i class="fa-solid fa-arrow-left me-2"></i>back
                </a>
            </div>

            <form action="{{ route('update#post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="" class="my-2">Post Title</label>
                <input type="hidden" name="postId" value="{{ $post['id'] }}">
                <input type="text" name="postTitle"
                    class="form-control shadow-sm mb-3 @error('postTitle') is-invalid @enderror"
                    placeholder="Enter title..." value="{{ old('postTitle', $post['title']) }}">
                @error('postTitle')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <label for="" class="my-2">Post Description</label>
                <textarea name="postDescription" class="form-control shadow-sm @error('postDescription') is-invalid @enderror"
                    id="" placeholder="Enter description..." cols="30" rows="10">{{ old('postDescription', $post['description']) }}</textarea>
                @error('postDescription')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="">
                    @if ($post->image == null)
                        <img class="img-thumbnail shadow-sm" src="{{ asset('404.png') }}" alt="">
                    @else
                        <img class="img-thumbnail shadow-sm" src="{{ asset('storage/' . $post->image) }}" alt="">
                    @endif
                </div>
                <label for="" class="my-2">Image</label>
                <input type="file" name="postImage"
                    class="form-control @error('postImage') is-invalid @enderror "
                    value="{{ old('postImage') }}">
                @error('postImage')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <label for="" class="my-2">Price</label>
                <input type="number" name="postPrice"
                    class="form-control @error('postPrice') is-invalid @enderror" value="{{ old('postPrice',$post['price']) }}"
                    placeholder="Enter post price">
                @error('postPrice')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <label for="" class="my-2">Address</label>
                <input type="text" name="postAddress"
                    class="form-control @error('postAddress') is-invalid @enderror"
                    value="{{ old('postAddress',$post['address']) }}" placeholder="Enter post Address">
                @error('postAddress')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <label for="" class="my-2">Rating</label>
                <input type="number" name="postRating"
                    class="form-control @error('postRating') is-invalid @enderror"
                    value="{{ old('postRating',$post['rating']) }}" placeholder="Enter post rating">
                @error('postRating')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <input type="submit" value="Update" class="btn btn-dark text-white float-end my-3">
            </form>
        </div>
    </div>
@endsection
