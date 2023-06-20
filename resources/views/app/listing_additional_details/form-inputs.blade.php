@php $editing = isset($listingAdditionalDetail) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="listing_id" label="Listing" required>
            @php $selected = old('listing_id', ($editing ? $listingAdditionalDetail->listing_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Listing</option>
            @foreach($listings as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $listingAdditionalDetail->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="value"
            label="Value"
            :value="old('value', ($editing ? $listingAdditionalDetail->value : ''))"
            maxlength="255"
            placeholder="Value"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="sequence"
            label="Sequence"
            :value="old('sequence', ($editing ? $listingAdditionalDetail->sequence : '0'))"
            max="255"
            placeholder="Sequence"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
