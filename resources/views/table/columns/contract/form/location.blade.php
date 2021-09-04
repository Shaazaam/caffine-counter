<template slot="id" slot-scope="props">
    <a
        href="#!"
        @click="selectLocation(props.record)"
    >Select</a>
    <br />
    <a
        href="#!"
        class="text-danger"
        @click="removeLocation(props.record)"
    >Remove</a>
</template>
<template slot="name" slot-scope="props">
    <vue-status-circle :status="props.record.status"></vue-status-circle>
    <span>
        <vue-link
            :endpoint="Routes.location.details"
            :params="[props.record.id]"
            target="_blank"
        >%{props.record.name}%</vue-link>
    </span>
    <br />
    <span class="small">Added On: %{Formatters.date(props.record.created_at)}%</span>
</template>
<template slot="address_one" slot-scope="props">
    %{props.record.address_one}%
    <template v-if="props.record.address_two">
        <br />%{props.record.address_two}%
    </template>
    <br />%{props.record.city}%, %{props.record.state}% %{props.record.zip}% %{props.record.country}%
</template>
<template slot="orders" slot-scope="props">
    <template v-for="(order, index) in props.record.orders">
        <br v-if="index !== 0" />
        <template v-if="!Functions.isUndefined(order.id) && Functions.isNotNull(order.id) && !Functions.equality.loose(order.id, 0)">
            <span class="fa" :class="Formatters.getIconForStatus(order.status) + ' ' + Formatters.stripSpaces(order.status)"></span>
            <span>
                <vue-link
                    :endpoint="Routes.order.details"
                    :params="[order.id]"
                    target="_blank"
                >%{order.service.name + ' - ' + order.work_order_number}%</vue-link>
            </span>
        </template>
        <template v-else-if="Functions.isNull(order.id)">
            %{order.service.name}% - Order to be Launched
        </template>
        <template v-else-if="Functions.equality.loose(order.id, 0)">
            %{order.service.name}% - Do Not Launch
        </template>
    </template>
</template>
<template slot="service" slot-scope="props">
    %{props.record.service.name}%
</template>
<template slot="monthly_recurring_charge" slot-scope="props">
    %{Formatters.currency(props.record.monthly_recurring_charge || 0)}%
</template>