<template slot="resource_number" slot-scope="props">
    <span class="fa" :class="[Formatters.getIconForStatus(props.record.status), Formatters.stripSpaces(props.record.status)]"></span>
    <span>
        <vue-link
            :endpoint="Routes.ticket.details"
            :params="[props.record.id]"
        >
            %{props.record.resource_number}%
        </vue-link>
    </span>
</template>
<template slot="resolution_code" slot-scope="props" v-if="Functions.isNotNull(props.record.resolution_id)">
    %{props.record.resolution_code}%
</template>
<template slot="created_at" slot-scope="props">
    %{Formatters.dateTimeFromServer(props.record.created_at)}%
</template>