<template slot="name" slot-scope="props">
    <span class="fa fa-circle-o" :class="Formatters.stripSpaces(props.record.status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.location.details"
            :params="[props.record.id]"
        >%{props.record.name}%</vue-link>
    </span>
    <br />
    <span class="small">Added On: %{Formatters.date(props.record.pivot.created_at)}%</span>
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
        <template v-if="index > 0">
            <br>
            <hr>
        </template>
        <template v-if="order.id">
            <span
                class="fa"
                :class="Formatters.getIconForStatus(order.status) + ' ' + Formatters.stripSpaces(order.status)"
            ></span>
            <span>
                <vue-link
                    :endpoint="Routes.order.details"
                    :params="[order.id]"
                >%{order.work_order_number}% - %{order.carrier_name}% - %{order.service_name}%</vue-link>
            </span>
            <template v-if="order.install_date">
                <br />
                <span class="small">Install Date: %{Functions.isNotEmpty(order.install_date) ? Formatters.date(order.install_date) : ''}%</span>
            </template>
        </template>
        <template v-else>
            Order to be Launched
        </template>
    </template>
</template>
<template slot="pivot" slot-scope="props">
    %{Formatters.currency(Functions.convertToDollars(props.record.pivot.monthly_recurring_charge))}%
</template>
<template slot="date_end" slot-scope="props">
    <template v-for="(order, index) in props.record.orders">
        <template v-if="index > 0">
            <br>
            <hr>
        </template>
        <div class="d-flex flex-column">
            <template v-if="order.id && order.install_date">
                <template v-if="getRemainingMonths(order.install_date, props.record.term) < 0 && Functions.equality.loose(props.record.renewal_term, 1)">
                    Month to Month
                </template>
                <template v-else>
                    %{getRemainingMonths(order.install_date, props.record.term)}% Months
                    <span class="small">Ends: %{getInstallEndDate(order.install_date, props.record.term)}%</span>
                </template>
                <span class="small fine-print">(Install Date)</span>
            </template>
            <template v-else>Order Not Installed</template>
        </div>
    </template>
</template>