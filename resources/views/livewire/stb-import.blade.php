<div>
    <h2 class="text-white text-xl bg-gray-900 my-5 p-3 rounded text-center">Import STB List</h2>
    <form wire:submit.prevent='importStb'>
        <div class="flex items-center justify-center w-1/2 mx-auto">
            <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                            upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Only Excel File</p>
                </div>
                <input wire:model.defer='excelFile' id="dropzone-file" type="file" class="hidden" />
            </label>
        </div>
        <div class="text-center">
            <button type="submit" class="p-3 rounded my-3 text-white bg-indigo-500">Upload</button>
        </div>
        @error('excelFile')
            <span class="text-red-500">{{$message}}</span>
        @enderror
        @if (session()->has('message'))
            <span class="font-semibold text-green-700">{{ session('message') }}</span>
        @endif
    </form>
</div>
