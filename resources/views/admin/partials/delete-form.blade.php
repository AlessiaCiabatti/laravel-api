<form action="{{ $route }}" method="POST"
    onsubmit="return confirm('{{ $message }}')">
    @csrf
    @method('DELETE')
    <button class="btn my_bgr"><i class="fa-solid fa-trash-can"></i></button>
</form>
