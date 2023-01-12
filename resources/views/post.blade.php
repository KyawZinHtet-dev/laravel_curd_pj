@extends('master')
@section('bodyCode')
    <div>
        <div class=" col col-4 offset-4 mt-2 shadow shadow-sm">
            @if (session('updateMsg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('updateMsg') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class=" col-6 offset-3 mt-2 card shadow shadow-md">
            <div class=" card-header d-flex justify-content-between">
                <div class=" col col-2">
                    <a href="{{ Session::get('prevUrl') }}" class=" text-decoration-none">
                        <button class=" btn btn-secondary"><i class="fa-solid fa-caret-left"></i>Back</button>
                    </a>
                </div>
                <div class=" col col-4 offset-6">
                    <h4>{{ $data['updated_at']->format('d-m-Y h:m A') }}</h4>
                </div>
            </div>
            <div class=" card-body">
                <div class=" text-center card-body shadow shadow-sm @if (!$data['image']) d-none @endif">
                    <img src="{{ asset('storage/' . $data['image']) }}" alt="post image" class=" mb-3 img-thumbnail">
                </div>
                <div class=" text-center mt-2">
                    <h3>{{ $data['title'] }}</h3>
                    <p>{{ $data['description'] }}</p>
                </div>
            </div>
            <div class=" card-footer">
                <div class=" row">
                    <div class=" text-start">
                        <small class=" text-warning">
                            <i class="fa-solid fa-star"></i>
                            <strong class=" text-dark">Rating:
                                {{ $data['rating'] }}
                            </strong>
                        </small><br>
                        <small class=" text-danger">
                            <i class="fa-solid fa-location-dot"></i>
                            <strong class=" text-dark">Location:
                                {{ $data['city'] }}
                            </strong>
                        </small><br>
                        <small class=" text-success">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <strong class=" text-dark">Price:
                                {{ $data['price'] }}Kyats
                            </strong>
                        </small>
                    </div>
                    <div class=" text-end">
                        <a href="{{ route('postEdit', $data['id']) }}" class=" text-decoration-none">
                            <button class=" btn btn-sm btn-success text-white"><i
                                    class="fa-solid fa-pen-to-square"></i>Edit</button>
                        </a>
                        <a href="{{ route('postDelete', $data['id']) }}" class=" text-decoration-none">
                            <button class="btn btn-sm btn-danger text-white"><i class="fa-solid fa-trash-can"></i>Delete
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
