<template slot="id" slot-scope="props">
    <span
        v-if="Role.isInternal()"
        class="fa"
        :class="Formatters.getIconForStatus(props.record.status) + ' ' + Formatters.stripSpaces(props.record.status)"
    ></span>
    <span>
        <vue-link
            :endpoint="Routes.bill.details"
            :params="[props.record.id]"
        >%{props.record.bill_number}%</vue-link>
    </span>
    @if (!Auth::user()->isCustomer())
        <br>
        <span class="small">
            %{props.record.status}%
            <img
                v-if="Functions.isNotNull(props.record.secondary_attachment_id)"
                v-tooltip:top="'File Fetch Invoice Attached'"
                src="{{asset('img/portal_ff_16.png')}}"
            >
        </span>
    @endif
</template>
<template slot="hierarchy_number" slot-scope="props">
    <span>
        <img
            v-if="Functions.isNotEmpty(props.record.hierarchy_number)"
            src="{{asset('img/hierarchy_icon.svg')}}"
            class="svg-icon"
        >
        %{props.record.hierarchy_number}%
    </span>
</template>
<template slot="customer_name" slot-scope="props">
    <vue-link
        :endpoint="Routes.customer.details"
        :params="[props.record.customer_id]"
    >%{props.record.customer_name}%</vue-link>
</template>
<template slot="location_name" slot-scope="props">
    <span class="fa fa-circle-o" :class="Formatters.stripSpaces(props.record.location_status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.location.details"
            :params="[props.record.location_id]"
        >%{props.record.location_name}%</vue-link>
    </span>
    <br>
    <span class="small">
        %{props.record.location_status}%
        <template v-if="props.record.location_sub_status">
            : %{props.record.location_sub_status}%
        </template>
    </span>
</template>
<template slot="order_id" slot-scope="props">
    <span class="fa" :class="Formatters.getIconForStatus(props.record.order_status) + ' ' + Formatters.stripSpaces(props.record.order_status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.order.details"
            :params="[props.record.order_id]"
        >%{props.record.carrier_name}% - %{props.record.service_facility_type}%</vue-link>
    </span>
    <template v-if="!Functions.isEmpty(props.record.order_speed)">
        <br>
        <span class="small">%{props.record.order_speed}%</span>
    </template>

    <template v-if="Functions.isNotEmpty(props.record.orders)">
        <template v-for="order in props.record.orders">
            <br>
            <span class="fa" :class="Formatters.getIconForStatus(order.status) + ' ' + Formatters.stripSpaces(order.status)"></span>
            <span>
                <vue-link
                    :endpoint="Routes.order.details"
                    :params="[order.id]"
                >%{order.carrier.name}% - %{order.service.facility}%</vue-link>
            </span>
        </template>
    </template>
</template>
<template slot="carrier_id" slot-scope="props">
    @if (!Auth::user()->isCustomer())
        <vue-link
            :endpoint="Routes.carrier.edit"
            :params="[props.record.carrier_id]"
        >%{props.record.carrier_name}%</vue-link>
    @else
        %{props.record.carrier_name}%
    @endif
</template>
<template slot="service_period" slot-scope="props">
    %{props.record.service_period_start}% - %{props.record.service_period_end}%
</template>
<template slot="service_month" slot-scope="props">
    %{props.record.service_month}%<br>
    <span class="small">%{props.record.service_year}%</span>
</template>
<template slot="billing_month" slot-scope="props">
    %{props.record.billing_month}%<br>
    <span class="small">%{props.record.billing_year}%</span>
</template>
<template slot="admin_id" slot-scope="props">
    <template v-if="Role.isBilling() || Role.isSuperAdmin()">
        <assign-user
            :model="props.record"
            property="admin_id"
            resource="bill"
            endpoint="assignAdmin"
            :users="props.data.assignableAdmins"
            @done="assignDone"
            @fail="fail"
            @always="always"
        ></assign-user>
    </template>
    <template v-else>
        %{props.record.admin_name}%
    </template>
</template>
<template slot="user_id" slot-scope="props">
    <template v-if="Role.isBilling() || Role.isSuperAdmin()">
        <assign-user
            :model="props.record"
            resource="bill"
            :users="props.data.assignableUsers"
            @done="assignDone"
            @fail="fail"
            @always="always"
        ></assign-user>
    </template>
    <template v-else>
        %{props.record.user_name}%
    </template>
</template>
<template slot="current_total" slot-scope="props">
    %{Formatters.currency(props.record.current_total)}%
</template>
<template slot="prior_total" slot-scope="props">
    %{Formatters.currency(props.record.prior_total)}%
</template>
<template slot="variance" slot-scope="props">
    <span :class="'text-' + props.record.variance_class">%{Formatters.percentage(props.record.variance)}%</span>
</template>
<template slot="updated_at" slot-scope="props">
    <span>%{Formatters.dateFromServer(props.record.updated_at)}%</span>
    <br>
    <span class="small">%{Formatters.timeFromServer(props.record.updated_at)}%</span>
</template>