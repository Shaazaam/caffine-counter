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
<template slot="current_total" slot-scope="props">
    %{Formatters.currency(props.record.current_total)}%
</template>
<template slot="service_period_end" slot-scope="props">
    %{props.record.service_month}%<br>
    <span class="small">%{props.record.service_year}%</span>
</template>
<template slot="variance" slot-scope="props">
    <span :class="'text-' + props.record.variance_class">%{Formatters.percentage(props.record.variance)}%</span>
</template>