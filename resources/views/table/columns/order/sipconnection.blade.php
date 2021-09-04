<template slot="channels" slot-scope="props">
    @if (!Auth::user()->isCustomer())
        <vue-link
            :endpoint="Routes.order.details"
            :params="[props.record.order_id, Routes.sipConnection.edit, props.record.id]"
        >%{props.record.channels}%</vue-link>
    @else
        %{props.record.channels}%
    @endif
</template>