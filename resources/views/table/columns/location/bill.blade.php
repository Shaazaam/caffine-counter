<template slot="bill_number" slot-scope="props">
    @if (!Auth::user()->isCustomer())
        <span class="fa" :class="Formatters.getIconForStatus(props.record.status) + ' ' + Formatters.stripSpaces(props.record.status)"></span>
    @endif
    <span>
        <vue-link
            :endpoint="Routes.bill.details"
            :params="[props.record.id]"
        >%{props.record.bill_number}%</vue-link>
    </span>
    @if (!Auth::user()->isCustomer())
        <br>
        <span class="small">%{props.record.status}%</span>
    @endif
</template>
<template slot="account_number" slot-scope="props">
    %{props.record.order.account_number}%
</template>
<template slot="order_id" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.order.status) + ' ' + Formatters.stripSpaces(props.record.order.status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.order.details"
            :params="[props.record.order_id]"
        >%{props.record.order.carrier.name}% - %{props.record.order.service.facility}%</vue-link>
    </span>
    <template v-if="Functions.isNotEmpty(props.record.order.speed)">
        <br>
        <span class="small">%{props.record.order.speed}%</span>
    </template>

    <template v-if="Functions.isNotEmpty(props.record.orders)">
        <template v-for="order in props.record.orders">
            <br>
            <span class="fa" :class="Formatters.getIconForStatus(order.status) + ' ' + Formatters.stripSpaces(order.status)"></span>
            <span>
                <vue-link
                    :endpoint="Routes.order.details"
                    :params="[order.id]"
                >%{order.carrier.name}% - %{order.service.facility}%</vue-link>
            </span>
        </template>
    </template>
</template>
<template slot="service_month" slot-scope="props">
    %{props.record.service_month}%
    <br>
    <span class="small">%{props.record.service_year}%</span>
</template>
<template slot="billing_month" slot-scope="props">
    %{props.record.billing_month}%
    <br>
    <span class="small">%{props.record.billing_year}%</span>
</template>
<template slot="current_total" slot-scope="props">
    %{Formatters.currency(props.record.current_total)}%
</template>