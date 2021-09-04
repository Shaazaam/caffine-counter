<template slot="resource_number" slot-scope="props">
    <span class="fa" :class="[Formatters.getIconForStatus(props.record.status), Formatters.stripSpaces(props.record.status)]"></span>
    <span>
        <vue-link
            :endpoint="Routes.ticket.details"
            :params="[props.record.id]"
        >
            %{props.record.resource_number}%
        </vue-link>
    </span>
</template>
<template slot="location_id" slot-scope="props">
    <template v-if="Functions.isNotNull(props.record.typeable.location_id) && Functions.isNotUndefined(props.record.typeable.location_id)">
        <span v-if="!Role.isCustomerLimited()">
            <vue-link
                :endpoint="Routes.location.details"
                :params="[props.record.typeable.location_id]"
            >%{props.record.typeable.location.name}%</vue-link>
        </span>
        <span v-else>
            %{props.record.typeable.location.name}%
        </span>
        <br />
        <span v-if="props.record.typeable.location.oracle_number" class="small">
            Cust. Loc. # %{props.record.typeable.location.oracle_number}%
        </span>
    </template>
    <template v-else-if="Functions.isUndefined(props.record.typeable.location_id) && props.record.isWireless">
        <em v-tooltip:bottom="'Unavailable on a wireless ticket'">N/A</em>
    </template>
</template>
<template slot="order_id" slot-scope="props">
    <template v-if="Functions.isNotNull(props.record.typeable.order_id) && Functions.isNotUndefined(props.record.typeable.order_id)">
        <span v-if="!Role.isCustomerLimited()">
            <vue-link
                :endpoint="Routes.order.details"
                :params="[props.record.typeable.order_id]"
            >%{props.record.typeable.order.service.name}%</vue-link>
        </span>
        <span v-else>
            %{props.record.typeable.order.service.name}%
        </span>
        <br />
        <span class="small">Order # %{props.record.typeable.order.work_order_number}%</span>
    </template>
    <template v-else-if="Functions.isUndefined(props.record.typeable.order_id) && props.record.isWireless">
        <em v-tooltip:bottom="'Unavailable on a wireless ticket'">N/A</em>
    </template>
</template>
<template slot="wireless_account_id" slot-scope="props">
    <template v-if="Functions.isNotNull(props.record.typeable.wireless_account_id) && Functions.isNotUndefined(props.record.typeable.wireless_account_id)">
        <span v-if="!Role.isCustomerLimited()">
            <vue-link
                :endpoint="Routes.wirelessAccount.details"
                :params="[props.record.typeable.wireless_account_id]"
            >%{props.record.wireless_account_name}%</vue-link>
        </span>
        <span v-else>
            %{props.record.wireless_account_name}%
        </span>
    </template>
    <template v-else-if="Functions.isUndefined(props.record.typeable.wireless_account_id) && props.record.isWired">
        <em v-tooltip:bottom="'Unavailable on a wired ticket'">N/A</em>
    </template>
</template>
<template slot="updated_at" slot-scope="props">
    %{Formatters.dateTimeFromServer(props.record.updated_at)}%
</template>