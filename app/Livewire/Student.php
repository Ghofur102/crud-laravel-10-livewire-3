<?php

namespace App\Livewire;

use App\Models\Students as ModelsStudents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Events\ModelsPruned;
use Livewire\Component;
use Livewire\WithPagination;

class Student extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $nama;
    public $email;
    public $alamat;
    public $updateData = false;
    public $idStudentUpdate;
    public $modalDelete = false;
    public $idStudentDelete;

    public function render()
    {
        $dataStudents = ModelsStudents::paginate(5);
        return view('livewire.student', compact('dataStudents'));
    }
    public function store()
    {
        $this->validate([
            "nama" => "required",
            "email" => "required|email",
            "alamat" => "required"
        ], [
            "nama.required" => "Nama tidak boleh kosong!",
            "email.required" => "Email tidak boleh kosong!",
            "email.email" => "Format email salah!",
            "alamat.required" => "Alamat tidak boleh kosong!",
        ]);
        ModelsStudents::create([
            "nama" => $this->nama,
            "email" => $this->email,
            "alamat" => $this->alamat
        ]);
        $this->nama = '';
        $this->email = '';
        $this->alamat = '';
        session()->flash('message', 'Data berhasil dimasukkan!');
    }
    public function edit(string $id)
    {
        $data = ModelsStudents::find($id);
        $this->nama = $data->nama;
        $this->email = $data->email;
        $this->alamat = $data->alamat;

        $this->updateData = true;
        $this->idStudentUpdate = $data->id;
    }
    public function update()
    {
        $this->validate([
            "nama" => "required",
            "email" => "required|email",
            "alamat" => "required"
        ], [
            "nama.required" => "Nama tidak boleh kosong!",
            "email.required" => "Email tidak boleh kosong!",
            "email.email" => "Format email salah!",
            "alamat.required" => "Alamat tidak boleh kosong!",
        ]);
        $updateData = ModelsStudents::find($this->idStudentUpdate);
        $updateData->nama = $this->nama;
        $updateData->email = $this->email;
        $updateData->alamat = $this->alamat;
        $updateData->save();

        $this->nama = '';
        $this->email = '';
        $this->alamat = '';
        $this->updateData = false;
        session()->flash('message', 'Data berhasil diupdate!');
    }
    public function delete_confirmation(string $id)
    {
        $this->modalDelete = true;
        $deleteData = ModelsStudents::find($id);
        $this->idStudentDelete = $deleteData->id;
    }
    public function closeModalDelete()
    {
        $this->modalDelete = false;
    }
    public function delete()
    {
        $deleteData = ModelsStudents::find($this->idStudentDelete);
        $deleteData->delete();
        $this->modalDelete = false;
        session()->flash('message', 'Data berhasil dihapus!');
    }
}
