<template slot="id" slot-scope="props">
     <vue-status-circle :status="props.record.status"></vue-status-circle> 
    <span>
        <vue-link
            :endpoint="Routes.opportunity.details"
            :params="[props.record.id]"
        >%{props.record.opportunity_number}%</vue-link>
    </span>
</template>
<template slot="customer_name" slot-scope="props">
    <vue-link
        :endpoint="Routes.customer.details"
        :params="[props.record.customer_id]"
    >%{props.record.customer_name}%</vue-link>
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
<template slot="location_ids" slot-scope="props">
    <template v-if="props.record.linked_location_count === 1">
        <vue-status-circle :status="props.record.linked_location_statuses"></vue-status-circle>
        <vue-link
            :endpoint="Routes.location.details"
            :params="[props.record.linked_location_ids]"
        >%{props.record.linked_location_numbers}%</vue-link>
        <br>
        <span class="small">
            %{props.record.linked_location_statuses}%<template v-if="Functions.isNotEmpty(props.record.linked_location_sub_statuses)">: %{props.record.linked_location_sub_statuses}%</template>
        </span>
    </template>
    <template v-else-if="props.record.linked_location_count > 1">
        %{props.record.linked_location_count}% Linked Locations
    </template>
</template>
<template slot="customer_lead_source" slot-scope="props">
    %{props.record.customer_lead_source}%<br>
    <span v-if="hasSubAgent(props.record.customer_lead_source)" class="text-muted small">
        (%{props.record.customer_sub_agent ? props.record.customer_sub_agent : 'No data'}%)
    </span>
</template>
<template slot="updated_at" slot-scope="props">
    <span>%{Formatters.dateTimeFromServer(props.record.updated_at)}%</span>
</template>
