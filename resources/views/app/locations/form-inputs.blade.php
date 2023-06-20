@php $editing = isset($location) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="municipality_id" label="Municipality" required>
            @php $selected = old('municipality_id', ($editing ? $location->municipality_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Municipality</option>
            @foreach($municipalities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $location->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ext_code"
            label="Ext Code"
            :value="old('ext_code', ($editing ? $location->ext_code : ''))"
            maxlength="255"
            placeholder="Ext Code"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="sequence"
            label="Sequence"
            :value="old('sequence', ($editing ? $location->sequence : '0'))"
            max="255"
            placeholder="Sequence"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
