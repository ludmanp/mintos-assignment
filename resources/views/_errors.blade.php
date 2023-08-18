<div class="text-red-500 text-center mb-5 @if ($errors->any()) hidden @endif" data-error>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
            @if(!$loop->last)
                <br/>
            @endif
        @endforeach
    @endif
</div>
