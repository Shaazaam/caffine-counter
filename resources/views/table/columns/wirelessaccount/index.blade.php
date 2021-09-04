<template slot="resource_number" slot-scope="props">
    <vue-status-circle :status="props.record.status"></vue-status-circle>
    <span>
        <vue-link
            :endpoint="Routes.wirelessAccount.details"
            :params="[props.record.id]"
        >%{props.record.resource_number}%</vue-link>
    </span>
    <br />
    <span class="small">%{props.record.status}%</span>
</template>
<template slot="customer_name" slot-scope="props">
    <vue-link
        :endpoint="Routes.customer.details"
        :params="[props.record.customer_id]"
    >%{props.record.customer_name}%</vue-link>
</template>
<template slot="carrier_name" slot-scope="props">
    @if (!Auth::user()->isCustomer())
        <vue-link
            :endpoint="Routes.carrier.edit"
            :params="[props.record.carrier_id]"
        >%{props.record.carrier_name}%</vue-link>
    @else
        %{props.record.carrier_name}%
    @endif
</template>