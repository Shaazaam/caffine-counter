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
<template slot="user_email" slot-scope="props">
    %{Functions.isNotNull(props.record.user_email) ? props.record.user_email : props.record.email}%
</template>