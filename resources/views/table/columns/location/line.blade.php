<template slot="order_id" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.order.status) + ' ' + Formatters.stripSpaces(props.record.order.status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.order.details"
            :params="[props.record.order_id]"
        >%{props.record.order.work_order_number}%</vue-link>
    </span>
    <br>
    <span class="small">%{props.record.order.status}%</span>
</template>
<template slot="number" slot-scope="props">
    @if (!Auth::user()->isCustomer())
        <vue-link
            :endpoint="Routes.order.details"
            :params="[props.record.order_id, props.record.order.service.type.toLowerCase() === 'pots' ? 'potsline' : 'prisipline', 'edit', props.record.id]"
        >%{props.record.number}%</vue-link>
    @else
        %{props.record.number}%
    @endif
</template>
<template slot="order" slot-scope="props">
    %{props.record.order.carrier.name}% - %{props.record.order.service.type}%
</template>