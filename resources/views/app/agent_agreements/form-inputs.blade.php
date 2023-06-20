@php $editing = isset($agentAgreement) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="agent_id" label="Agent" required>
            @php $selected = old('agent_id', ($editing ? $agentAgreement->agent_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Agent</option>
            @foreach($agents as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="agency_commission_percentage"
            label="Agency Commission Percentage"
            :value="old('agency_commission_percentage', ($editing ? $agentAgreement->agency_commission_percentage : '0'))"
            max="255"
            step="0.01"
            placeholder="Agency Commission Percentage"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="salespeople_commission_percentage"
            label="Salespeople Commission Percentage"
            :value="old('salespeople_commission_percentage', ($editing ? $agentAgreement->salespeople_commission_percentage : '0'))"
            max="255"
            step="0.01"
            placeholder="Salespeople Commission Percentage"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
