@php $editing = isset($salesPeopleAgreement) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="sales_people_id" label="Sales People" required>
            @php $selected = old('sales_people_id', ($editing ? $salesPeopleAgreement->sales_people_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Sales People</option>
            @foreach($allSalesPeople as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="district_id" label="District" required>
            @php $selected = old('district_id', ($editing ? $salesPeopleAgreement->district_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the District</option>
            @foreach($districts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="salespeople_commission_percentage"
            label="Salespeople Commission Percentage"
            :value="old('salespeople_commission_percentage', ($editing ? $salesPeopleAgreement->salespeople_commission_percentage : ''))"
            max="255"
            step="0.01"
            placeholder="Salespeople Commission Percentage"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
