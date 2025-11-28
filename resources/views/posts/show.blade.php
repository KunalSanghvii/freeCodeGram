@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class ="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="ps-2">
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 45px">
                    </div>
                    <div>
                        <div class="fw-bold">
                            <a href="/profile/{{ $post->user->id}}">
                                <span class="text-dark">{{ $post->user->username}}</span>
                            </a> |
                            <a href = "#" class="ps-2">Follow</a>
                        </div>
                    </div>
                </div>

                <hr></hr>

                <p>
                    <span class="fw-bold">
                        <a href="/profile/{{ $post->user->id}}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span>
                    {{ $post->caption }}
                </p>


            </div>
        </div>
    </div>
</div>
@endsection
