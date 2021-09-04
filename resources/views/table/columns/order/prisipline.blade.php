<template slot="number" slot-scope="props">
    <span v-if="Role.isInternalManager()">
        <vue-link
            :endpoint="Routes.order.details"
            :params="[props.record.order_id, Routes.priSipLine.edit, props.record.id]"
        >%{props.record.number}%</vue-link>
    </span>
    <span v-else>
        %{props.record.number}%
    </span>
</template>
<template slot="order_id" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.order_status) + ' ' + Formatters.stripSpaces(props.record.order_status)"></span>
    <vue-link
        :endpoint="Routes.order.details"
        :params="[props.record.order_id]"
    >%{props.record.order_work_order_number}%</vue-link>
</template>
<template slot="disconnect_date" slot-scope="props">
    %{Functions.isNotEmpty(props.record.disconnect_date) ? Formatters.dateFromServer(props.record.disconnect_date) : ''}%
</template>