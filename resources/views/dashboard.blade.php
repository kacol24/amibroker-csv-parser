<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('import') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="flex justify-between">
                            <div>
                                <label for="file">
                                    File Upload
                                </label>
                                <input type="file" name="file" id="file" class="block">
                            </div>
                            <div>
                                <button type="submit"
                                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                    <table class="table-auto w-full mt-4"></table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
