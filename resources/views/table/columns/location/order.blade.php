<template slot="work_order_number" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.status) + ' ' + Formatters.stripSpaces(props.record.status)"></span>
    <vue-link
        :endpoint="Routes.order.details"
        :params="[props.record.id]"
    >%{props.record.work_order_number}%</vue-link>
    <br>
    @if (Auth::user()->isInternal())
        <sticky-note-popup
            :record="props.record"
            :type="type"
            @click="stickyClick"
        ></sticky-note-popup>
    @endif
    <span class="small">%{props.record.status}%</span>
</template>
<template slot="service_name" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.status) + ' ' + Formatters.stripSpaces(props.record.status)"></span>
    <span>%{props.record.service_name}% 
        <span v-if="Functions.isNotEmpty(props.record.uses)" class="text-muted small">
            (%{selectedUses(props.record)}%)
        </span>
    </span>
    <br>
    <span class="small">%{props.record.carrier_name}%</span>
</template>
<template slot="account_number" slot-scope="props">
    %{props.record.account_number}%<br v-if="props.record.speed">
    <span class="small" v-if="props.record.speed">%{props.record.speed}%</span>
</template>
<template slot="install_deadline" slot-scope="props">
    <span v-if="Functions.isNotNull(props.record.install_deadline)">%{Formatters.dateFromServer(props.record.install_deadline)}%</span>
    <span v-else>N/A</span>
</template>
<template slot="install_date" slot-scope="props">
    <span v-if="Functions.isNotNull(props.record.install_date)">%{Formatters.dateFromServer(props.record.install_date)}%</span>
    <span v-else>N/A</span>
</template>