<template slot="name" slot-scope="props">
    <vue-link
        :endpoint="Routes.service.edit"
        :params="[props.record.id]"
    >%{props.record.name}%</vue-link>
    <span v-if="props.record.is_draft" class="text-muted">(DRAFT)</span>
</template>
<template slot="is_draft" slot-scope="props">
    <span v-if="props.record.is_draft" class="fa fa-check"></span>
</template>
<template slot="updated_at" slot-scope="props">
    <span>%{Formatters.dateFromServer(props.record.updated_at)}%</span><br>
    <span class="small">%{Formatters.timeFromServer(props.record.updated_at)}%</span>
</template>