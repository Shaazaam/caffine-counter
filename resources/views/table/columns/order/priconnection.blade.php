<template slot="connection_type" slot-scope="props">
    @if (!Auth::user()->isCustomer())
        <vue-link
            :endpoint="Routes.order.details"
            :params="[props.record.order_id, Routes.priConnection.edit, props.record.id]"
        >%{props.record.connection_type}%</vue-link>
    @else
        %{props.record.connection_type}%
    @endif
</template>