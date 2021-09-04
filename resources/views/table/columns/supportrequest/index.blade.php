<template slot="subject" slot-scope="props">
    <span>
        <vue-link
            :endpoint="Routes.supportRequest.details"
            :params="[props.record.id]"
        >%{props.record.subject}%</vue-link>
    </span>
</template>
<template slot="from" slot-scope="props">
    <span>
        %{props.record.from_name}% (%{props.record.from_email}%)
    </span>
</template>
<template slot="to" slot-scope="props">
    <span>
        <span v-if="Functions.isNotEmpty(props.record.group_id)">%{props.record.group_name}%: </span>
        %{props.record.to_email}%
    </span>
</template>
<template slot="created_at" slot-scope="props">
    <span>%{Formatters.dateFromServer(props.record.created_at)}%</span>
    <br>
    <span class="small">%{Formatters.timeFromServer(props.record.created_at)}%</span>
</template>