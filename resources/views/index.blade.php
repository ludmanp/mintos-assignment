@extends('_master')

@section('title', 'RSS Reader')

@section('content')
    <div class="max-w-screen-xl mx-auto p-16">
        @include('auth.logout')

        <div class="sm:grid lg:grid-cols-4 sm:grid-cols-2 gap-5">
            @foreach($items as $item)
                @include('list.item', compact('item'))
            @endforeach
        </div>
    </div>
@endsection
