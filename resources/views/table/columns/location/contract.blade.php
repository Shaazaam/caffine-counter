<template slot="contract_number" slot-scope="props">
    <span class="fa fa-circle-o" :class="Formatters.stripSpaces(props.record.status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.contract.details"
            :params="[props.record.id]"
        >%{props.record.contract_number}%</vue-link>
    </span>
    <br>
    <span class="small">%{props.record.status}%</span>
</template>
<template slot="term" slot-scope="props">
    %{props.record.term}% Months
</template>
<template slot="date_end" slot-scope="props">
    <div class="d-flex justify-content-around align-items-center">
        <div class="d-flex flex-column" v-if="Functions.isNotNull(props.record.order_install_date)">
            <template v-if="getRemainingMonths(props.record.order_install_date, props.record.term) < 0 && Functions.equality.loose(props.record.renewal_term, 1)">
                Month to Month
            </template>
            <template v-else>
                %{getRemainingMonths(props.record.order_install_date, props.record.term)}% Months
                <span class="small">Ends %{getInstallEndDate(props.record.order_install_date, props.record.term)}%</span>
            </template>
            <span class="small fine-print">(Install Date)</span>
        </div>
        <span v-else style="margin-bottom:6px;">Order Not Installed</span>
        <span class="table-cell-divider-vertical"></span>
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