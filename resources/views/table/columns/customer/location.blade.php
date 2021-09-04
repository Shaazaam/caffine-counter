<template slot="name" slot-scope="props">
    <span class="fa fa-circle-o" :class="Formatters.stripSpaces(props.record.status)"></span>
    <span>
        <vue-link
            :endpoint="Routes.location.details"
            :params="[props.record.id]"
        >
            %{props.record.name}%
            <span v-if="props.record.status === 'Prospect'" class="text-muted">(Prospect)</span>
        </vue-link>
    </span>
    <br>
    <sticky-note-popup
        :record="props.record"
        :type="type"
        @click="stickyClick"
    ></sticky-note-popup>
    <span class="small">
        %{props.record.status}%
        <template v-if="props.record.sub_status">
            : %{props.record.sub_status}%
        </template>
    </span>
    <template v-if="props.record.hasOpen >= 1">
        <span class="fa fa-bookmark pull-right" data-toggle="tooltip" title="This location has an open trouble ticket"></span>
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
    <span>%{Formatters.date(props.record.updated_at)}%</span><br>
    <span class="small">%{Formatters.timeFromServer(props.record.updated_at)}%</span>
</template>
<template slot="user_id" slot-scope="props">
    <location-owner
        :location="props.record"
        :assignable-users="assignableUsers"
        @location-assigned-done="done"
        @location-assigned-failure="failure"
        @location-assigned-always="always"
    ></location-owner>
</template>
