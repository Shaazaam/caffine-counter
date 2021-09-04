<template slot="resource_number" slot-scope="props">
    <span class="fa" :class="[Formatters.getIconForStatus(props.record.status), Formatters.stripSpaces(props.record.status)]"></span>
    <span>
        <vue-link
            :endpoint="Routes.ticket.details"
            :params="[props.record.id]"
        >%{props.record.resource_number}%</vue-link>
    </span>
</template>
<template slot="customer_name" slot-scope="props">
    %{props.record.customer_name}%
</template>
<template slot="created_at" slot-scope="props">
    <span>%{Formatters.dateFromServer(props.record.created_at)}%</span>
    <br>
    <span class="small">%{Formatters.timeFromServer(props.record.created_at)}%</span>
</template>