<template slot="resource_number" slot-scope="props">
    <span class="fa" :class="[Formatters.getIconForStatus(props.record.status), Formatters.stripSpaces(props.record.status)]"></span>
    <span>
        <vue-link
            :endpoint="Routes.ticket.details"
            :params="[props.record.id]"
        >%{props.record.resource_number}%</vue-link>
    </span>
    <br>
    <span class="small">%{props.record.status}%</span>
</template>
<template slot="resolution" slot-scope="props">
    %{props.record.resolution}%
</template>
<template slot="created_at" slot-scope="props">
    <span>%{Formatters.dateFromServer(props.record.created_at)}%</span>
    <br>
    <span class="small">%{Formatters.timeFromServer(props.record.created_at)}%</span>
</template>
<template slot="updated_at" slot-scope="props">
    <span>%{Formatters.dateFromServer(props.record.updated_at)}%</span>
    <br>
    <span class="small">%{Formatters.timeFromServer(props.record.updated_at)}%</span>
</template>