<template slot="resource_number" slot-scope="props">
    <vue-status-circle :status="props.record.status"></vue-status-circle>
    <span>
        <vue-link
            :endpoint="Routes.ticket.details"
            :params="[props.record.id]"
        >%{props.record.resource_number}%</vue-link>
    </span>
    <br />
    <span class="small">%{props.record.status}%</span>
</template>