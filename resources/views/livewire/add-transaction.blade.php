<div>
    <div class="p-6 relative">
        <h2 class="text-center font-semibold mb-3 text-xl">Add Transactions</h2>
        <svg wire:click="$dispatch('closeModal')" class="absolute right-4 top-4 cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#EA3323"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                <!-- Nuid -->
                <div>
                    <label for="nuid" class="block text-sm font-medium text-gray-700">Nuid</label>
                    <input wire:model.defer='nuid' type="text" id="nuid"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-200 cursor-not-allowed"
                        disabled>
                </div>

                <!-- Types -->
                <div>
                    <label for="types" class="block text-sm font-medium text-gray-700">Types</label>
                    <select id="types" wire:model.defer="types"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select Type</option>
                        <!-- Add options here -->
                        @foreach ($availableTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->types }}</option>
                        @endforeach
                    </select>
                    @error('types')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Building -->
                <div>
                    <label for="building" class="block text-sm font-medium text-gray-700">Building</label>
                    <select id="building" wire:model.defer="building"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select Building</option>
                        <!-- Add options here -->
                        @foreach ($allBuildings as $building)
                            <option value="{{ $building->id }}">{{ $building->name }}</option>
                        @endforeach
                    </select>
                    @error('building')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" id="address" wire:model.defer="address"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('address')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Technician -->
                <div>
                    <label for="technician" class="block text-sm font-medium text-gray-700">Technician</label>
                    <select id="technician" wire:model.defer="technician"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select Technician</option>
                        <!-- Add options here -->
                        @foreach ($availableTech as $tech)
                            <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                        @endforeach
                    </select>
                    @error('technician')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Complain Id -->
                <div>
                    <label for="complain_id" class="block text-sm font-medium text-gray-700">Complain Id</label>
                    <input type="text" id="complain_id" wire:model.defer="complainId"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    {{-- @error('complainId') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror --}}
                </div>
                <!-- Note -->
                <div>
                    <label for="note" class="block text-sm font-medium text-gray-700">Exchange For</label>
                    <input type="text" id="note" wire:model.defer="exchangeFor"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('exchangeFor')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                    <input type="text" id="note" wire:model.defer="note"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>
            @if (session()->has('message'))
                <div class="text-center mt-2">
                    <span class="p-1  bg-green-100 text-green-600 font-semibold rounded">{{ session('message') }}</span>
                </div>
            @endif
            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
