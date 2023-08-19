{{--{{ dd($item) }}--}}
<div
        class="hover:bg-gray-900 hover:text-white transition duration-300 max-w-sm rounded overflow-hidden shadow-lg">
    <div class="py-4 px-4">
        <a href="{{ $item->get('link') }}" target="_blank">
            <div class="flex items-center justify-between leading-tight">
                <span class="text-xs">{{ $item->get('category') }}</span>
                <div class="text-xs text-right text-gray-400">{{ $item->get('date') }}</div>
            </div>

            @if($item->get('imageUrl'))
                <img src="{{ $item->get('imageUrl') }}" class="w-100" alt="{{ $item->get('title') }}">
            @endif

            <h4 class="text-lg mb-3 font-semibold">{{ $item->get('title') }}</h4>
            <p class="mb-2 text-sm text-gray-600">{!! strip_tags($item->get('description'), ['br']) !!}</p>
        </a>
    </div>
</div>
