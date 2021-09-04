<template slot="id" slot-scope="props">
    <vue-status-circle :status="props.record.status"></vue-status-circle>
    <span>
        <vue-link
            :endpoint="Routes.contract.details"
            :params="[props.record.id]"
            target="_blank"
        >%{props.record.contract_number}%</vue-link>
    </span>
    <br>
    <span class="small">%{props.record.status}%</span>
</template>
<template slot="order_work_order_number" slot-scope="props">
    <template v-if="props.record.order_id">
        <span
            class="fa"
            :class="Formatters.getIconForStatus(props.record.order_status) + ' ' + Formatters.stripSpaces(props.record.order_status)"
        ></span>
        <span>
            <vue-link
                :endpoint="Routes.order.details"
                :params="[props.record.order_id]"
                target="_blank"
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
                <template v-if="getRemainingMonths(props.record.order_install_date, props.record.term) < 0 && Functions.equality.loose(props.record.renewal_term, 1)">
                    Month to Month
                </template>
                <template v-else>
                    %{getRemainingMonths(props.record.order_install_date, props.record.term)}% Months
                    <span class="small">Ends %{getInstallEndDate(props.record.order_install_date, props.record.term)}%</span>
                </template>
                <span class="small fine-print">(Install Date)</span>
            </div>
        </template>
        <span v-else style="margin-bottom:6px;">Order Not Installed</span>
        <div class="d-flex flex-column">
            <template v-if="getRemainingMonths(props.record.date_signed, props.record.term) < 0 && Functions.equality.loose(props.record.renewal_term, 1)">
                Month to Month
            </template>
            <template v-else>
                %{getRemainingMonths(props.record.date_signed, props.record.term)}% Months
                <span class="small">Ends %{props.record.date_end_display}%</span>
            </template>
            <span class="small fine-print">(Sign Date)</span>
        </div>
    </div>
</template>