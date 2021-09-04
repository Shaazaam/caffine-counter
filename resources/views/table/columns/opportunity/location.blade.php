<template slot="id" slot-scope="props">
    <vue-status-circle :status="props.record.status"></vue-status-circle>
    <span>
        <vue-link
            :endpoint="Routes.location.details"
            :params="[props.record.id]"
        >%{props.record.resource_number}%</vue-link>
    </span>
</template>
<template slot="address" slot-scope="props">
    %{props.record.address_one}%
    <template v-if="props.record.address_two">
        <br />%{props.record.address_two}%
    </template>
    <br />%{props.record.city}%, %{props.record.state}% %{props.record.zip}% %{props.record.country}%
</template>
<template slot="active_services" slot-scope="props">
    <div v-for="order in props.record.orders">
        <vue-status-circle :status="order.status"></vue-status-circle>
        <vue-link
            :endpoint="Routes.order.details"
            :params="[order.id]"
        >%{order.service_name}%</vue-link>
    </div>
</template>
