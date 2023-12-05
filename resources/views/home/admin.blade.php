
<ul>
    <li>
        <button type="button" class="btn btn-warning">
            <a href="update/{{$book->id}}" class="link-body-emphasis">Edit Jumlah</a>
        </button>
    </li>
    <li>
        <button type="button" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
            <a href="hapus/{{$book->id}}" class="link-body-emphasis">Hapus</a>
        </button>
    </li>
</ul>