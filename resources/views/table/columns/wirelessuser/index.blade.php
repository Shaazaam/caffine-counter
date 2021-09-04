<template slot="name" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.status) + ' ' + Formatters.stripSpaces(props.record.status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.wirelessUser.edit"
            :params="[props.record.id]"
        >%{props.record.name}%</vue-link>
    </span>
    <br>
    <span class="small">%{props.record.status}%</span>
</template>
@if (!Auth::user()->isCustomer())
    <template slot="customer_name" slot-scope="props">
        <vue-link
            :endpoint="Routes.customer.details"
            :params="[props.record.customer_id]"
        >%{props.record.customer_name}%</vue-link>
    </template>
@endif
