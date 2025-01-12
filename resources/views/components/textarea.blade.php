<textarea {!! $attributes->merge([
    'class' =>
        'mt-1 block w-full p-2.5 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white',
]) !!}>{{ $slot }}</textarea>
