<template slot="id" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.status) + ' ' + Formatters.stripSpaces(props.record.status)"></span>
    <vue-link
        :endpoint="Routes.order.details"
        :params="[props.record.id]"
    >%{props.record.work_order_number}%</vue-link>
    <br>
    @if (!Auth::user()->isCustomer())
        <sticky-note-popup
            :record="props.record"
            :type="type"
            @click="stickyClick"
        ></sticky-note-popup>
    @endif
    <span class="small">%{props.record.status}%</span>
</template>
<template slot="location_name" slot-scope="props">
    <span class="fa fa-circle-o" :class="Formatters.stripSpaces(props.record.location_status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.location.details"
            :params="[props.record.location_id]"
        >%{props.record.location_name}%</vue-link>
    </span>
    <br><span class="small">
        %{props.record.location_status}%
        <template v-if="props.record.location_sub_status">
            : %{props.record.location_sub_status}%
        </template>
    </span>
</template>
<template slot="location_id" slot-scope="props">
    %{props.record.location_address_one}%<br>
    <template v-if="props.record.location_address_two">
        %{props.record.location_address_two}%<br>
    </template>
    %{props.record.location_city}%, %{props.record.location_state}% %{props.record.location_zip}% %{props.record.location_country}%
</template>
<template slot="customer_name" slot-scope="props">
    <vue-link
        :endpoint="Routes.customer.details"
        :params="[props.record.customer_id]"
    >%{props.record.customer_name}%</vue-link>
</template>
<template slot="service_name" slot-scope="props">
    @if (!Auth::user()->isCustomer())
        <vue-link
            :endpoint="Routes.service.edit"
            :params="[props.record.service_id]"
        >%{props.record.service_name}%</vue-link>
    @else
        %{props.record.service_name}%
    @endif
</template>
<template slot="carrier_name" slot-scope="props">
    @if (!Auth::user()->isCustomer())
        <vue-link
            :endpoint="Routes.carrier.edit"
            :params="[props.record.carrier_id]"
        >%{props.record.carrier_name}%</vue-link>
    @else
        %{props.record.carrier_name}%
    @endif
</template>
<template slot="install_deadline" slot-scope="props">
    <span v-if="props.record.install_deadline">%{props.record.install_deadline}%</span>
    <span v-else>N/A</span>
</template>
<template slot="install_date" slot-scope="props">
    <span v-if="props.record.install_date">%{props.record.install_date}%</span>
    <span v-else>N/A</span>
</template>
<template slot="updated_at" slot-scope="props">
    <span>%{Formatters.dateFromServer(props.record.updated_at)}%</span><br>
    <span class="small">%{Formatters.timeFromServer(props.record.updated_at)}%</span>
</template>