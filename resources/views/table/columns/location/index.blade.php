<template slot="name" slot-scope="props">
    <span class="fa fa-circle-o" :class="Formatters.stripSpaces(props.record.status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.location.details"
            :params="[props.record.id]"
        >%{props.record.name}%</vue-link>
    </span>
    <br>
    @if (!Auth::user()->isCustomer())
        <sticky-note-popup
            :record="props.record"
            :type="type"
            @click="stickyClick"
        ></sticky-note-popup>
    @endif
    <span class="small">
        %{props.record.status}%
        <template v-if="props.record.sub_status">
            : %{props.record.sub_status}%
        </template>
    </span>
    <template v-if="Functions.isNotNull(props.record.ticket_id)">
        <span class="fa fa-bookmark pull-right" v-tooltip:auto="'This location has an open trouble ticket'"></span>
    </template>
</template>
<template slot="customer_name" slot-scope="props">
    <vue-link
        :endpoint="Routes.customer.details"
        :params="[props.record.customer_id]"
    >%{props.record.customer_name}%</vue-link>
</template>
<template slot="user_id" slot-scope="props">
    <template v-if="Role.isInternal() && MetaContent.canAssignLocation()">
        <assign-user
            :model="props.record"
            resource="location"
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
<template slot="address_one" slot-scope="props">
    %{props.record.address_one}%<br>
    <template v-if="props.record.address_two">
        %{props.record.address_two}%<br>
    </template>
    %{props.record.city}%, %{props.record.state}% %{props.record.zip}% %{props.record.country}%
</template>
<template slot="updated_at" slot-scope="props">
    <span>%{Formatters.dateFromServer(props.record.updated_at)}%</span><br>
    <span class="small">%{Formatters.timeFromServer(props.record.updated_at)}%</span>
</template>