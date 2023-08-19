@extends('_master')

@section('title', 'RSS Reader')

@section('content')
    <div class="max-w-screen-xl mx-auto p-16">
        <div class="mb-2 text-right">
        <a href="{{ route('logout') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 text-sm rounded">
            Logout
        </a>
        </div>


        <div class="sm:grid lg:grid-cols-4 sm:grid-cols-2 gap-5">
            @foreach($items as $item)
                @include('list.item', compact('item'))
            @endforeach
        </div>
    </div>
@endsection
