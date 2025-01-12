@props([
    'id' => 'modal_id',
    'title' => 'Modal-Title',
    'buttonText' => 'Submit',
    'action' => '#',
    'method' => 'POST',
])

<div id="{{ $id }}"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ $title }}
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="{{ $id }}">
                    X
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal Content -->
            <form action="{{ $action }}" method="{{ $method }}">
                @csrf
                <div class="p-4 md:p-5 space-y-4">
                    {{ $slot }}
                </div>
                <div class="flex justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit"
                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        {{ $buttonText }}
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>
