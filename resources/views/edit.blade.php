@extends('master')
@section('bodyCode')
    <div class=" col card">
        <div class=" col-6 offset-3 mt-2">
            <div class="row shadow shadow-md mt-1 p-3">
                <div class=" col col-2">
                    <a href="{{ route('showMore', $data['id']) }}" class=" text-decoration-none">
                        <button class=" btn btn-secondary"><i class="fa-solid fa-caret-left"></i>Back</button>
                    </a>
                </div>
                <div class=" col col-4 offset-6">
                    <h4>{{ $data['updated_at']->format('d-m-Y h:m A') }}</h4>
                </div>
            </div>
            {{-- @php
                dd($errors);
            @endphp --}}
            <div class=" p-3 card-body shadow shadow-md mt-3">
                <form action="{{ route('postUpdate', $data['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="text-group mb-2">
                        <label for="title" class=" text-black">Enter Post Title</label>
                        <input class=" form-control @error('title') is-invalid @enderror" type="text" name="title"
                            id="title" placeholder="Enter Post Title...." value="{{ old('title', $data['title']) }}">
                        @error('title')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-group mb-2">
                        <label for="description" class=" text-black">Enter Post Description</label>
                        <textarea class=" form-control @error('description') is-invalid @enderror" name="description" id="description"
                            cols="30" rows="5" placeholder="Enter Post Description....">{{ old('description', $data['description']) }}</textarea>
                        @error('description')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class=" text-group mb-2">
                        <label for="image" class=" text-black">Post Image</label>
                        <input type="file" name="image" id="image" name="image"
                            class=" form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class=" invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        @if ($data['image'])
                            <small class=" text-success">Current image is: {{ $data['image'] }}</small>
                            <div>
                                <a href="{{ route('delImg', $data['id']) }}" class=" text-decoration-none text-black"><i
                                        class="fa-solid fa-xmark"></i></a><br>
                                <img src="{{ asset('/storage/' . $data['image']) }}" alt="postImage"
                                    class=" img-thumbnail w-25 h-25">
                            </div>
                        @else
                            <small class=" text-warning">No Image in this post!</small>
                        @endif
                    </div>

                    <div class="text-group
                            mb-2">
                        <label for="city" class=" text-black">Location</label>
                        <input class=" form-control @error('city') is-invalid @enderror" type="text" name="city"
                            id="city" placeholder="Enter City...." value="{{ old('city', $data['city']) }}">
                        @error('city')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-group mb-2">
                        <label for="price" class=" text-black">Post Price</label>
                        <input class=" form-control @error('price') is-invalid @enderror" type="number" name="price"
                            id="price" placeholder="Enter Price...." value="{{ old('price', $data['price']) }}">
                        @error('price')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-group mb-2">
                        <label for="rating" class=" text-black">Post Rating</label>
                        <input class=" form-control @error('rating') is-invalid @enderror" type="number" min="0"
                            max="5" name="rating" id="rating" placeholder="Enter Rating...."
                            value="{{ old('rating', $data['rating']) }}">
                        @error('rating')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
            <div class=" card-footer">
                <div class=" text-center">
                    <input type="submit" value="Update" class=" btn btn-primary w-50 btn-xs">
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
