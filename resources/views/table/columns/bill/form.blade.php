<template slot="id" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.status) + ' ' + Formatters.stripSpaces(props.record.status)"></span>
    <a
        href="#"
        @click="editBill(props.record)"
    >
        %{props.record.bill_number}%
    </a>
    <br>
    <span class="small">%{props.record.status}%</span>
</template>
<template slot="account_number" slot-scope="props">
    %{props.record.order.account_number}%
</template>
<template slot="customer_id" slot-scope="props">
    <vue-link
        :endpoint="Routes.customer.details"
        :params="[props.record.customer_id]"
        target="_blank"
    >%{props.record.customer.name}%</vue-link>
</template>
<template slot="location_id" slot-scope="props">
    <span class="fa fa-circle-o" :class="Formatters.stripSpaces(props.record.location.status)"></span>
    <vue-link
        :endpoint="Routes.location.details"
        :params="[props.record.location_id]"
        target="_blank"
    >%{props.record.location.name}%</vue-link>
    <br>
    <span class="small">
        %{props.record.location.address_one}%%{props.record.location.address_two ? ' ' + props.record.location.address_two : ''}% %{props.record.location.city}%, %{props.record.location.state}% %{props.record.location.zip}% %{props.record.location.country}%
    </span>
</template>
<template slot="order_id" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.order.status) + ' ' + Formatters.stripSpaces(props.record.order.status)"></span>
    <vue-link
        :endpoint="Routes.order.details"
        :params="[props.record.order_id]"
        target="_blank"
    >
        %{props.record.order.carrier.name}% - %{props.record.order.service.facility || props.record.order.service.type}%
    </vue-link>
    <br>
    <span class="small">
        %{props.record.order.speed}%
    </span>
</template>
<template slot="carrier_id" slot-scope="props">
    <vue-link
        :endpoint="Routes.carrier.edit"
        :params="[props.record.carrier_id]"
        target="_blank"
    >%{props.record.carrier.name}%</vue-link>
</template>
<template slot="service_period" slot-scope="props">
    %{props.record.service_period_start}% - %{props.record.service_period_end}%
</template>
<template slot="service_month" slot-scope="props">
    %{props.record.service_month_string}%
    <br>
    <span class="small">
        %{props.record.service_year}%
    </span>
</template>
<template slot="billing_month" slot-scope="props">
    %{props.record.billing_month_string}%
    <br>
    <span class="small">
        %{props.record.billing_year}%
    </span>
</template>
<template slot="current_total" slot-scope="props">
    %{Formatters.currency(props.record.current_total)}%
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
            <span class="bold">Subtotal: %{Formatters.currency(totals.sub_total_no_administration_fees)}%</span>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-xs-12 text-right">
            <span class="bold">Grand Total: %{Formatters.currency(totals.total)}%</span>
        </div>
    </div>
</template>