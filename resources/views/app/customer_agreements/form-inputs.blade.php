@php $editing = isset($customerAgreement) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="customer_id" label="Customer" required>
            @php $selected = old('customer_id', ($editing ? $customerAgreement->customer_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Customer</option>
            @foreach($customers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="district_id" label="District" required>
            @php $selected = old('district_id', ($editing ? $customerAgreement->district_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the District</option>
            @foreach($districts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="agency_commission_percentage"
            label="Agency Commission Percentage"
            :value="old('agency_commission_percentage', ($editing ? $customerAgreement->agency_commission_percentage : '0'))"
            max="255"
            step="0.01"
            placeholder="Agency Commission Percentage"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
