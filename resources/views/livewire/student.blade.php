<div class="container">
    @if ($modalDelete === true)
    <div class="modal" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='closeModalDelete()'></button>
                </div>
                <div class="modal-body">
                    <p>Yakin mau menghapus data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click='delete()'>Hapus</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- START FORM -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        @if ($errors->any())
            <div class="pt-3">
                <div class="alert alert-danger error">
                    {{ $errors->first() }}
                </div>
            </div>
        @endif
        @if (session()->has('message'))
            <div class="pt-3">
                <div class="alert alert-success success">
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <form>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" wire:model="nama">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" wire:model='email'>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" wire:model='alamat'>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    @if ($updateData === true)
                        <button type="button" class="btn btn-primary" name="submit" wire:click="update()">
                            UPDATE
                        </button>
                    @else
                        <button type="button" class="btn btn-primary" name="submit" wire:click="store()">
                            SIMPAN
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>
    <!-- AKHIR FORM -->

    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h1>Data Siswa</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-4">Nama</th>
                    <th class="col-md-3">Email</th>
                    <th class="col-md-2">Alamat</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataStudents as $urut => $student)
                    <tr>
                        <td>{{ $dataStudents->firstItem() + $urut }}</td>
                        <td>{{ $student->nama }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->alamat }}</td>
                        <td>
                            <button type="button" wire:click='edit({{ $student->id }})'
                                class="btn btn-warning btn-sm">Edit</button>
                            <button type="button" wire:click='delete_confirmation({{ $student->id }})'
                                class="btn btn-danger btn-sm">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{ $dataStudents->links() }}
        </table>

    </div>
    <!-- AKHIR DATA -->
</div>
