<template slot="id" slot-scope="props">
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
    </span>
</template>
<template slot="wireless_account_name" slot-scope="props">
    <span>
        <vue-link
            :endpoint="Routes.wirelessAccount.details"
            :params="[props.record.wireless_account_id]"
        >
            %{props.record.wireless_account_name}%
        </vue-link>
    </span>
</template>