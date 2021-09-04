<template slot="id" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.status) + ' ' + Formatters.stripSpaces(props.record.status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.opportunity.details"
            :params="[props.record.id]"
        >%{props.record.opportunity_number}%</vue-link>
    </span>
    <br>
    <span class="small">%{props.record.status}%</span>
</template>
<template slot="confidence" slot-scope="props">
    <v-meter
        :bars="bars"
        :value="props.record.confidence"
        readonly
    ></v-meter>
</template>
