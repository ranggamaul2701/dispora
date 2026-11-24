<form method="POST" action="{{ $action }}" data-confirm="{{ $pesan }}" style="display:inline">
    @csrf @method('DELETE')
    <button type="submit" class="btn-i bi-del" title="Hapus"><i class="bi bi-trash"></i></button>
</form>
