<template slot="opportunity_number" slot-scope="props">
     <vue-status-circle :status="props.record.status"></vue-status-circle> 
    <span>
        <vue-link
            :endpoint="Routes.opportunity.details"
            :params="[props.record.id]"
        >%{props.record.opportunity_number}%</vue-link>
    </span>
</template>
<template slot="confidence" slot-scope="props">
    <v-meter
        :bars="bars"
        :value="props.record.confidence"
        readonly
    ></v-meter>
</template>
<template slot="total_projected_monthly_recurring_charge" slot-scope="props">
    %{Formatters.currency(props.record.total_projected_monthly_recurring_charge)}%
</template>
<template slot="total_projected_non_recurring_charge" slot-scope="props">
    %{Formatters.currency(props.record.total_projected_non_recurring_charge)}%
</template>
<template slot="updated_at" slot-scope="props">
    %{Formatters.dateTimeFromServer(props.record.updated_at)}%
</template>
<template slot="lead_source" slot-scope="props">
    %{props.record.lead_source}%
    <span v-if="customer.hasSubAgent" class="text-muted">
        (%{props.record.sub_agent}%)
    </span>
</template>