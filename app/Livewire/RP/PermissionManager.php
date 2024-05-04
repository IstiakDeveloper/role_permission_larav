<?php

namespace App\Livewire\RP;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionManager extends Component
{
    public $permissions;
    public $name;
    public $selectedRole;
    public $roles;
    public $editingPermissionId = null;

    protected $rules = [
        'name' => 'required|unique:permissions,name',
    ];

    public function mount()
    {
        $this->permissions = Permission::all();
        $this->roles = Role::all();
    }

    public function createPermission()
    {
        $this->validate();

        $permission = Permission::create([
            'name' => $this->name,
        ]);

        if ($this->selectedRole) {
            $role = Role::findOrFail($this->selectedRole);
            $role->givePermissionTo($permission);
        }

        $this->reset(['name', 'selectedRole']);
        $this->mount();
    }

    public function editPermission($id)
    {
        $permission = Permission::findOrFail($id);
        $this->editingPermissionId = $permission->id;
        $this->name = $permission->name;
        $this->selectedRole = $permission->roles->pluck('id')->toArray();
    }

    public function updatePermission($id)
    {
        $this->validate([
            'name' => ['required', Rule::unique('permissions')->ignore($id)],
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update(['name' => $this->name]);

        if ($this->selectedRole) {
            $roles = Role::findOrFail($this->selectedRole);
            $permission->syncRoles($roles);
        }

        $this->reset(['name', 'selectedRole', 'editingPermissionId']);
        $this->mount();
    }

    public function deletePermission($id)
    {
        Permission::findOrFail($id)->delete();
        $this->reset(['name', 'selectedRole']);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.r-p.permission-manager');
    }
}
