<div>
    <div class="bg-white p-6 rounded-lg w-full mx-auto relative">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Edit Technician</h2>
        <svg wire:click="$dispatch('closeModal')" class="absolute right-4 top-4 cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#EA3323"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
        <form wire:submit.prevent="editTechnician">
            <!-- Name Input -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                <input type="text" wire:model.defer="name" name="name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your name">
                @error('name')
                    <span class="text-red-500 font font-semibold text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mobile Input -->
            <div class="mb-4">
                <label for="mobile" class="block text-gray-700 font-bold mb-2">Mobile</label>
                <input maxlength="11" minlength="11" type="tel" wire:model.defer="mobile" name="mobile"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your mobile number">
                @error('mobile')
                    <span class="text-red-500 font font-semibold text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" wire:model.defer="email" name="email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your email">
                    @error('email')
                    <span class="text-red-500 font font-semibold text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">Submit</button>
            </div>
        </form>
        @if ($success)
            <h4 class="text-green-500 text-center font-semibold">{{ $success }}</h4>
        @endif
    </div>
</div>
