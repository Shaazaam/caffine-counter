<template slot="action" slot-scope="props">
    <button class="btn btn-link" @click="unlink(props.record.id)">Unlink</button>
</template>
<template slot="id" slot-scope="props">
    <vue-link
        :endpoint="Routes.quoteRequest.details"
        :params="[props.record.id]"
    >%{props.record.quote_request_number}%</vue-link>
</template>
<template slot="location_name" slot-scope="props">
    <vue-link
        :endpoint="Routes.location.details"
        :params="[props.record.location.id]"
    >%{props.record.location.name}%</vue-link>
    <br>
    <span class="small">%{props.record.location.address_one}%<span v-if="props.record.location.address_two">, %{props.record.location.address_two}%</span>,
    %{props.record.location.city}%, %{props.record.location.state}% %{props.record.location.zip}%</span>
</template>
<template slot="location_number" slot-scope="props">
    %{props.record.location.oracle_number}%
</template>
<template slot="location_orders" slot-scope="props">
    <template v-for="order in props.record.location.orders">
        <vue-status-circle :status="order.status"></vue-status-circle>
        <vue-link
            :endpoint="Routes.order.details"
            :params="[order.id]"
        >%{formatOrderName(order)}%</vue-link>
        <br>
    </template>
</template>