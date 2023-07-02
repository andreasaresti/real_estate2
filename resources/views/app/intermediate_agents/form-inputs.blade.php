@php $editing = isset($intermediateAgent) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $intermediateAgent->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $intermediateAgent->address : ''))"
            maxlength="255"
            placeholder="Address"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="city"
            label="City"
            :value="old('city', ($editing ? $intermediateAgent->city : ''))"
            maxlength="255"
            placeholder="City"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="country"
            label="Country"
            :value="old('country', ($editing ? $intermediateAgent->country : ''))"
            maxlength="255"
            placeholder="Country"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="telephone"
            label="Telephone"
            :value="old('telephone', ($editing ? $intermediateAgent->telephone : ''))"
            maxlength="255"
            placeholder="Telephone"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $intermediateAgent->email : ''))"
            maxlength="255"
            placeholder="Email"
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="website"
            label="Website"
            :value="old('website', ($editing ? $intermediateAgent->website : ''))"
            maxlength="255"
            placeholder="Website"
        ></x-inputs.text>
    </x-inputs.group>
</div>
