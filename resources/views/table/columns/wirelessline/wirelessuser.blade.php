<template slot="id" slot-scope="props">
    <span>
        <vue-link
            :endpoint="Routes.wirelessUser.edit"
            :params="[props.record.id]"
        >%{props.record.name}%</vue-link>
</template>
<template slot="created_at" slot-scope="props">
    <span>%{Formatters.dateFromServer(props.record.created_at)}%</span>
</template>