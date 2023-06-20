@php $editing = isset($salesPeople) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="customer_id" label="Customer" required>
            @php $selected = old('customer_id', ($editing ? $salesPeople->customer_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Customer</option>
            @foreach($customers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="agent_id" label="Agent" required>
            @php $selected = old('agent_id', ($editing ? $salesPeople->agent_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Agent</option>
            @foreach($agents as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $salesPeople->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="active"
            label="Active"
            :checked="old('active', ($editing ? $salesPeople->active : 1))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
