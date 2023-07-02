@php $editing = isset($chargeRequestCollectMoney) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="sales_request_id" label="Sales Request" required>
            @php $selected = old('sales_request_id', ($editing ? $chargeRequestCollectMoney->sales_request_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Sales Request</option>
            @foreach($salesRequests as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="sales_people_id" label="Sales People">
            @php $selected = old('sales_people_id', ($editing ? $chargeRequestCollectMoney->sales_people_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Sales People</option>
            @foreach($allSalesPeople as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="amount"
            label="Amount"
            :value="old('amount', ($editing ? $chargeRequestCollectMoney->amount : '0'))"
            max="255"
            step="0.01"
            placeholder="Amount"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="commission_amount"
            label="Commission Amount"
            :value="old('commission_amount', ($editing ? $chargeRequestCollectMoney->commission_amount : '0'))"
            max="255"
            step="0.01"
            placeholder="Commission Amount"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
