<template slot="phone_number" slot-scope="props">
    <span class="fa fa-circle-o" :class="Formatters.stripSpaces(props.record.status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.wirelessLine.details"
            :params="[props.record.id]"
        >
            %{props.record.phone_number}%
        </vue-link>
    </span>
    <br>
    <span class="small">
        %{props.record.status}%
        <template v-if="props.record.sub_status">
            - %{props.record.sub_status}%
        </template>
    </span>
</template>
<template slot="customer_name" slot-scope="props">
    <span>
        <vue-link
            :endpoint="Routes.customer.details"
            :params="[props.record.customer_id]"
        >
            %{props.record.customer_name}%
        </vue-link>
    </span>
</template>
<template slot="wireless_account_name" slot-scope="props">
    <span v-if="!Role.isCustomer()">
        <vue-link
            :endpoint="Routes.wirelessAccount.details"
            :params="[props.record.wireless_account_id]"
        >
            %{props.record.wireless_account_name}%
        </vue-link>
    </span>
    <span v-else>
        %{props.record.wireless_account_name}%
    </span>
</template>
