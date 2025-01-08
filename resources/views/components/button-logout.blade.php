<form method="post" action="{{route('logout')}}" class="block px-4 py-2 hover:bg-blue-700">
    @csrf
    <button type="submit" class="hover:cursor-pointer">Logout</button>
</form>
