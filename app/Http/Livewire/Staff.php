<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Staff as StaffModel;

class Staff extends Component
{
    public $users, $lastname, $firstname, $phone, $role, $status, $password, $user_id;
    public $updateMode = false;

    public function render()
    {
        $this->users = StaffModel::whereIn('role', ['admin', 'superadmin', 'accounting', 'marketing'])->get();
        return view('livewire.staff');
    }

    private function resetInputFields()
    {
        $this->firstname = '';
        $this->lastname = '';
        $this->phone = '';
        $this->role = '';
        $this->status = '';
        $this->password = '';
    }
    public function store()
    {
        $validatedDate = $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required|unique:users',
            'role' => 'required',
            'password' => 'required',
        ]);
        StaffModel::create($validatedDate);

        session()->flash('message', 'Staff Created Successfully.');

        $this->resetInputFields();

        $this->emit('userStore'); // Close model to using to jquery
    }
    public function edit($id)
    {
        $this->updateMode = true;
        $user = StaffModel::where('id', $id)->first();
        $this->user_id = $id;
        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->phone = $user->phone;
        $this->role = $user->role;
        $this->status = $user->status;
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
    public function update()
    {
        $validatedDate = $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required|unique:users',
            'role' => 'required',
            'status' => 'nullable',
            'password' => 'nullable',
        ]);
        if ($this->user_id) {
            $user = StaffModel::find($this->user_id);
            $user->update([
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'phone' => $this->phone,
                'role' => $this->role,
                // 'status' => $this->status,
                'password' => $this->password ? bcrypt($this->password) : $user->password,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Staff Updated Successfully.');
            $this->resetInputFields();
        }
    }
    public function delete($id)
    {
        if ($id) {
            $user = StaffModel::find($id);
            $user->status = 'inactive';
            $user->archive_reason = $request->archive_reason;
            $user->archived_at = Carbon::now();
            session()->flash('message', 'Staff Deleted Successfully.');
        }
    }
}
