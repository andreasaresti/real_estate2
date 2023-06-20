@php $editing = isset($language) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="encoding"
            label="Encoding"
            :value="old('encoding', ($editing ? $language->encoding : ''))"
            maxlength="255"
            placeholder="Encoding"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $language->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="sequence"
            label="Sequence"
            :value="old('sequence', ($editing ? $language->sequence : '0'))"
            max="255"
            placeholder="Sequence"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
