<template slot="id" slot-scope="props">
    <vue-status-circle :status="props.record.status"></vue-status-circle>
    <span>
        <vue-link
            :endpoint="Routes.contract.details"
            :params="[props.record.id]"
        >%{props.record.resource_number}%</vue-link>
    </span>
    <br>
    <span class="small">%{props.record.status}%</span>
</template>
<template slot="customer_name" slot-scope="props" v-if="Role.isInternal()">
    <vue-link
        :endpoint="Routes.customer.details"
        :params="[props.record.customer_id]"
    >%{props.record.customer_name}%</vue-link>
</template>
<template slot="location_name" slot-scope="props">
    <vue-status-circle :status="props.record.location_status"></vue-status-circle>
    <span>
        <vue-link
            :endpoint="Routes.location.details"
            :params="[props.record.location_id]"
        >%{props.record.location_name}%</vue-link>
    </span>
    <br>
    <span class="small">
        Added On: %{props.record.location_created_at}%
    </span>
</template>
<template slot="location_address_one" slot-scope="props">
    %{props.record.location_address_one}%
    <template v-if="props.record.location_address_two">
        <br />%{props.record.location_address_two}%
    </template>
    <br />%{props.record.location_city}%, %{props.record.location_state}% %{props.record.location_zip}% %{props.record.location_country}%
</template>
<template slot="order_work_order_number" slot-scope="props">
    <template v-if="props.record.order_id">
        <span
            class="fa"
            :class="[Formatters.getIconForStatus(props.record.order_status), Formatters.stripSpaces(props.record.order_status)]"
        ></span>
        <span>
            <vue-link
                :endpoint="Routes.order.details"
                :params="[props.record.order_id]"
            >%{props.record.order_work_order_number}%</vue-link>
        </span>
        <br>
        <span class="small">%{props.record.order_status}%</span>
    </template>
    <template v-else>
        Order to be Launched
    </template>
</template>
<template slot="date_signed" slot-scope="props">
    %{props.record.date_signed}%
</template>
<template slot="date_end" slot-scope="props">
    <div class="d-flex flex-column">
        <template v-if="props.record.order_id && props.record.order_install_date">
            <div class="d-flex flex-column" style="margin-bottom:6px;">
                <template v-if="Dates.getRemainingMonths(props.record.order_install_date, props.record.term) < 0 && Functions.equality.loose(props.record.renewal_term, 1)">
                    Month to Month
                </template>
                <template v-else>
                    %{Dates.getRemainingMonths(props.record.order_install_date, props.record.term)}% Months
                    <span class="small">Ends %{Dates.getInstallEndDate(props.record.order_install_date, props.record.term)}%</span>
                </template>
                <span class="small fine-print">(Install Date)</span>
            </div>
        </template>
        <span v-else style="margin-bottom:6px;">Order Not Installed</span>
        <div class="d-flex flex-column">
            <template v-if="Dates.getRemainingMonths(props.record.date_signed, props.record.term) < 0 && Functions.equality.loose(props.record.renewal_term, 1)">
                Month to Month
            </template>
            <template v-else>
                %{Dates.getRemainingMonths(props.record.date_signed, props.record.term)}% Months
                <span class="small">Ends %{Formatters.stringOrNoDataState(props.record.date_end)}%</span>
            </template>
            <span class="small fine-print">(Sign Date)</span>
        </div>
    </div>
</template>
<template slot="monthly_recurring_charge" slot-scope="props">
    %{Formatters.currency(props.record.monthly_recurring_charge)}%
</template>
<template slot="total" slot-scope="props">
    %{Formatters.currency(props.record.total)}%
</template>