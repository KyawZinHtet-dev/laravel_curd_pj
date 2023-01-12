@extends('master')
@section('bodyCode')
    <div class=" container">
        <div class=" row mt-4">
            <div class=" col col-6 offset-3">
                @if (session('deleteMsg'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('deleteMsg') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class=" col col-5">
                @if (session('successMsg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('successMsg') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card shadow shadow-md mt-1">
                    <div class=" p-3 card-body">
                        <form action="{{ route('postCreate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="text-group mb-2">
                                <label for="title" class=" text-black">Post Title</label>
                                <input class=" form-control @error('title') is-invalid @enderror" type="text"
                                    name="title" id="title" placeholder="Enter Post Title...."
                                    value="{{ old('title') }}">
                                @error('title')
                                    <div class=" invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-group mb-2">
                                <label for="description" class=" text-black">Post Description</label>
                                <textarea class=" form-control @error('description') is-invalid @enderror" name="description" id="description"
                                    cols="30" rows="4" placeholder="Enter Post Description....">{{ old('description') }}</textarea>
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
                            <div class="text-group
                                    mb-2">
                                <label for="city" class=" text-black">Location</label>
                                <input class=" form-control @error('city') is-invalid @enderror" type="text"
                                    name="city" id="city" placeholder="Enter City...." value="{{ old('city') }}">
                                @error('city')
                                    <div class=" invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-group mb-2">
                                <label for="price" class=" text-black">Post Price</label>
                                <input class=" form-control @error('price') is-invalid @enderror" type="number"
                                    name="price" id="price" placeholder="Enter Price...."
                                    value="{{ old('price') }}">
                                @error('price')
                                    <div class=" invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-group mb-2">
                                <label for="rating" class=" text-black">Post Rating</label>
                                <input class=" form-control @error('rating') is-invalid @enderror" type="number"
                                    min="0" max="5" name="rating" id="rating"
                                    placeholder="Enter Rating...." value="{{ old('rating') }}">
                                @error('rating')
                                    <div class=" invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class=" text-center">
                                <input type="submit" value="Create" class=" btn btn-primary w-50 btn-xs mt-2">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col col-1"></div>
            <div class="col col-6">
                <div class="row">
                    <div class=" col col-5">
                        <h3>Total Posts is {{ $dbData->total() }}</h3>
                    </div>
                    <div class=" col col-6 offset-1">
                        <form action="{{ route('showPage') }}" method="GET">
                            <div class="input-group rounded">
                                <input type="search" class=" form-control form-control-sm" placeholder="Search"
                                    aria-label="Search" aria-describedby="search-addon" name="sKey"
                                    value="{{ request('sKey') }}" />
                                <button class="input-group-text border-0 btn btn-primary" id="search-addon"
                                    type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (count($dbData) != 0)
                    @foreach ($dbData as $items)
                        <div class="post p-3 shadow shadow-md mt-3">
                            <div class="row">
                                <h4 class="col col-8">{{ $items['title'] }}</h4>
                                <h5 class=" col-3 offset-1">{{ $items['updated_at']->format('d-M-Y h:m A') }}</h5>
                            </div>
                            <p>{{ Str::words($items['description'], 20, '...') }}</p>
                            <div class=" d-flex justify-content-between align-items-end">
                                <div>
                                    <small class=" text-warning">
                                        <i class="fa-solid fa-star"></i>
                                        <strong class=" text-dark">Rating:
                                            {{ $items['rating'] }}
                                        </strong>
                                    </small><br>
                                    <small class=" text-danger">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <strong class=" text-dark">Location:
                                            {{ $items['city'] }}
                                        </strong>
                                    </small><br>
                                    <small class=" text-success">
                                        <i class="fa-solid fa-dollar-sign"></i>
                                        <strong class=" text-dark">Price:
                                            {{ $items['price'] }}Kyats
                                        </strong>
                                    </small>
                                </div>
                                <div>
                                    <a href="{{ route('showMore', $items['id']) }}"
                                        class=" text-decoration-none d-inline-block">
                                        <button class="btn btn-sm btn-primary text-white">
                                            See More <i class="fa-solid fa-caret-down"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class=" card shadow shadow-md mt-5">
                        <div class="card-body">
                            <div>
                                <h4 class=" text-danger text-center">No result found!</h4>
                            </div>
                            <div>
                                <a href="{{ route('postCreate') }}" class=" text-decoration-none">
                                    <button class=" btn btn-danger btn-sm">
                                        <i class="fa-solid fa-caret-left"></i>Back</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class=" col col-8 offset-2 mt-5"> {{ $dbData->appends(request()->query())->links() }}</div>
                @if (request('sKey'))
                    <div class="text-center mt-4">
                        <a href="{{ route('showPage') }}" class=" btn btn-primary btn-sm"><i
                                class="fa-solid fa-caret-left"></i>Back
                            to home page</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
