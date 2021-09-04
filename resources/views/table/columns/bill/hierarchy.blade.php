<template slot="id" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.status) + ' ' + Formatters.stripSpaces(props.record.status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.bill.details"
            :params="[props.record.id]"
        >%{props.record.bill_number}%</vue-link>
    </span>
    <br>
    <span class="small">%{props.record.status}%</span>
</template>
<template slot="location_name" slot-scope="props">
    <span class="fa fa-circle-o" :class="Formatters.stripSpaces(props.record.location_status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.location.details"
            :params="[props.record.location_id]"
        >%{props.record.location_name}%</vue-link>
    </span>
    <br>
    <span class="small">
        %{props.record.location_status}%
        <template v-if="props.record.location_sub_status">
            : %{props.record.location_sub_status}%
        </template>
    </span>
</template>
<template slot="order_id" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.order_status) + ' ' + Formatters.stripSpaces(props.record.order_status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.order.details"
            :params="[props.record.order_id]"
        >%{props.record.carrier_name}% - %{props.record.service_facility_type}%</vue-link>
    </span>
    <template v-if="props.record.order_status === 'Disconnected'">
        <br><span class="small">%{props.record.order_sub_status}%</span>
    </template>
    <template v-else-if="Functions.isNotEmpty(props.record.order_speed)">
        <br><span class="small">%{props.record.order_speed}%</span>
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
<template slot="carrier_name" slot-scope="props" v-if="Role.isInternal()">
    <vue-link
        :endpoint="Routes.carrier.edit"
        :params="[props.record.carrier_id]"
    >%{props.record.carrier_name}%</vue-link>
</template>
<template slot="service_period" slot-scope="props">
    %{props.record.service_period_start}% - %{props.record.service_period_end}%
</template>
<template slot="service_month" slot-scope="props">
    %{props.record.service_month}%<br>
    <span class="small">%{props.record.service_year}%</span>
</template>
<template slot="billing_month" slot-scope="props">
    %{props.record.billing_month}%<br>
    <span class="small">%{props.record.billing_year}%</span>
</template>
<template slot="current_total" slot-scope="props">
    %{Formatters.currency(props.record.current_total)}%
</template>
<template slot="variance" slot-scope="props">
    <span :class="'text-' + props.record.variance_class">%{Formatters.percentage(props.record.variance)}%</span>
</template>
<template slot="footer">
    <hr>

    <div class="row">
        <div class="col-xs-12">
            <p class="bold text-muted">Totals</p>
        </div>
    </div>
    {{-- form-group is used here to create a blank row below this row; see https://stackoverflow.com/a/42115838/ --}}
    <div class="form-group bills-totals-table">
        <div>
            <span class="bold text-muted">MRC:</span>
            <span class="bold">%{Formatters.currency(totals.monthly_recurring_charge)}%</span>
        </div>
        <div>
            <span class="bold text-muted">Pro-Rated:</span>
            <span class="bold">%{Formatters.currency(totals.pro_rated)}%</span>
        </div>
        <div>
            <span class="bold text-muted">NRC:</span>
            <span class="bold">%{Formatters.currency(totals.non_recurring_charge)}%</span>
        </div>
        <div>
            <span class="bold text-muted">Long Distance:</span>
            <span class="bold">%{Formatters.currency(totals.long_distance)}%</span>
        </div>
        <div>
            <span class="bold text-muted">Taxes &amp; Fees:</span>
            <span class="bold">%{Formatters.currency(totals.taxes_fees)}%</span>
        </div>
        <div>
            <span class="bold text-muted">Admin Fee:</span>
            <span class="bold">%{Formatters.currency(totals.administration_fee)}%</span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-right">
            <span class="bold">Subtotal: %{Formatters.currency(totals.sub_total)}%</span>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-xs-12 text-right">
            <span class="bold">Grand Total: %{Formatters.currency(totals.total)}%</span>
        </div>
    </div>
</template>