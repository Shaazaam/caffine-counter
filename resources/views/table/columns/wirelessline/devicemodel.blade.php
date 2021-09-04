<template slot="model" slot-scope="props">
    <span v-if="Role.isSuperAdmin() || Role.isWirelessAdmin()">
        <vue-link
            :endpoint="Routes.deviceModel.edit"
            :params="[props.record.id]"
        >%{props.record.manufacturer}% %{props.record.model}% %{props.record.storage_capacity}% %{props.record.color}%</vue-link>
    </span>
    <span v-else>
        %{props.record.manufacturer}% %{props.record.model}% %{props.record.storage_capacity}% %{props.record.color}%
    </span>
</template>
<template slot="created_at" slot-scope="props">
    <span>%{Formatters.dateFromServer(props.record.created_at)}%</span>
</template>