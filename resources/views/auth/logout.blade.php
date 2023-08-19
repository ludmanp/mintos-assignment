<div class="mb-2 text-right">
    <form method="post" action="{{ route('logout') }}">
        @csrf()
        <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 text-sm rounded">
            Logout
        </button>
    </form>
</div>
