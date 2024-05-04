<div class="rounded-2xl p-12 bg-gradient-to-b from-white via-gray-100 to-gray-200 backdrop-blur-lg backdrop-filter border border-gray-200">
    <!-- Role Form -->
    <form @if ($selectedRole) wire:submit.prevent="updateRole" @else wire:submit.prevent="createRole" @endif class="mb-4">
        <!-- Role Name Input -->
        <input type="text" wire:model.defer="name" class="form-input rounded-md shadow-sm w-full" placeholder="Enter Role Name">
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-2">
            @if ($selectedRole)
                Update Role
            @else
                Create Role
            @endif
        </button>
    </form>

    <!-- Role Table -->
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 bg-gray-50"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap">{{ $role->name }}</td>
                <td class="px-6 py-4 whitespace-no-wrap">
                    <button wire:click="editRole({{ $role->id }})" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded">Edit</button>
                    <button wire:click="deleteRole({{ $role->id }})" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
