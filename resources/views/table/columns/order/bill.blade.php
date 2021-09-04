<template slot="header">Approved Bills</template>
<template slot="id" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.status) + ' ' + Formatters.stripSpaces(props.record.status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.bill.details"
            :params="[props.record.id]"
        >%{props.record.bill_number}%</vue-link>
    </span>
</template>
<template slot="service_period_start" slot-scope="props">
    %{props.record.service_period_start}% - %{props.record.service_period_end}%
</template>
<template slot="current_total" slot-scope="props">
    %{Formatters.currency(props.record.current_total)}%
</template>