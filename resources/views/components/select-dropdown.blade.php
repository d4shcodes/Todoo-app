<select {!! $attributes->merge([
 'class' => 'mt-1 block w-full p-2.5 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500',
]) !!}>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach
</select>
