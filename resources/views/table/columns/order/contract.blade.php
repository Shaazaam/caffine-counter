<template slot="contract_number" slot-scope="props">
    <span class="fa fa-circle-o" :class="Formatters.stripSpaces(props.record.status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.contract.details"
            :params="[props.record.id]"
        >%{props.record.contract_number}%</vue-link>
    </span>
</template>
<template slot="term" slot-scope="props">
    %{Formatters.getStringTerm(props.record.term)}%
</template>
<template slot="date_end" slot-scope="props">
    <div class="d-flex justify-content-around align-items-center">

        <div
            v-if="Functions.isNotNull(order.install_date)"
            class="d-flex flex-column"
        >
            <template v-if="Dates.getRemainingMonths(order.install_date, props.record.term) < 0 && props.record.renewal_term === 1">
                Month to Month
            </template>
            <template v-else>
                %{Dates.getRemainingMonths(order.install_date, props.record.term)}% Months
                <span class="small">Ends %{Dates.getInstallEndDate(order.install_date, props.record.term)}%</span>
            </template>
            <span class="small fine-print">(Install Date)</span>
        </div>
        <span v-else >Order Not Installed</span>

        <span class="table-cell-divider-vertical"></span>

        <div class="d-flex flex-column">
            <template v-if="props.record.monthsRemainingFromSignDate < 0 && props.record.renewal_term === 1">
                Month to Month
            </template>
            <template v-else>
                %{props.record.monthsRemainingFromSignDate}% Months
                <span class="small">Ends %{props.record.dateEndTwoYear}%</span>
            </template>
            <span class="small fine-print">(Sign Date)</span>
        </div>
    </div>
</template>
