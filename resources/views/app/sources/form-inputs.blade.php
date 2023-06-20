@php $editing = isset($source) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $source->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="website"
            label="Website"
            :value="old('website', ($editing ? $source->website : ''))"
            maxlength="255"
            placeholder="Website"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="sequence"
            label="Sequence"
            :value="old('sequence', ($editing ? $source->sequence : '0'))"
            max="255"
            placeholder="Sequence"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
