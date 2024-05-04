<div class="rounded-2xl p-12 bg-gradient-to-b from-white via-gray-100 to-gray-200 backdrop-blur-lg backdrop-filter border border-gray-200">
    @if ($editingPermissionId)
        <!-- Update Permission Form -->
        <form wire:submit.prevent="updatePermission({{ $editingPermissionId }})" class="mb-4">
    @else
        <!-- Create Permission Form -->
        <form wire:submit.prevent="createPermission" class="mb-4">
    @endif
        <input type="text" wire:model.defer="name" class="w-full form-input rounded-md shadow-sm" placeholder="Enter Permission Name">
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

        <!-- Role Selection -->
        <select wire:model="selectedRole" class="w-full form-select rounded-md shadow-sm mt-2 px-4 py-2">
            <option value="">Select Role</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-2">
            @if ($editingPermissionId)
                Update Permission
            @else
                Create Permission
            @endif
        </button>
    </form>

    <!-- Permission List -->
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Associated Role</th>
                <th class="px-6 py-3 bg-gray-50"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $permission->name }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        @if ($permission->roles->isNotEmpty())
                            {{ $permission->roles->implode('name', ', ') }}
                        @else
                            None
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <button wire:click="editPermission({{ $permission->id }})" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded">Edit</button>
                        <button wire:click="deletePermission({{ $permission->id }})" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
