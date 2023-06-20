@php $editing = isset($status) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ext_code"
            label="Ext Code"
            :value="old('ext_code', ($editing ? $status->ext_code : ''))"
            maxlength="255"
            placeholder="Ext Code"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $status->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="sequence"
            label="Sequence"
            :value="old('sequence', ($editing ? $status->sequence : '0'))"
            max="255"
            placeholder="Sequence"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
