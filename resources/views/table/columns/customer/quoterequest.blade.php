<template slot="quote_request_number" slot-scope="props">
    <vue-status-circle :status="props.record.status"></vue-status-circle>
    <vue-link
        :endpoint="Routes.quoteRequest.details"
        :params="[props.record.id]"
    >%{props.record.quote_request_number}%</vue-link>
    <div v-if="props.record.quote_request_group_id">
        <img src="{{asset('img/hierarchy_icon.svg')}}" class="svg-icon"/>
        <vue-link
            :endpoint="Routes.quoteRequestGroup.details"
            :params="[props.record.quote_request_group_id]"
        >%{props.record.quote_request_group_number}%</vue-link>
    </div>
</template>
<template slot="location_name" slot-scope="props">
    <vue-link
        :endpoint="Routes.location.details"
        :params="[props.record.location_id]"
    >%{props.record.location_name}%</vue-link>
</template>
<template slot="location_address_one" slot-scope="props">
    %{props.record.location_address_one}%
    <template v-if="props.record.location_address_two">
        <br />%{props.record.location_address_two}%
    </template>
    <br />%{props.record.location_city}%, %{props.record.location_state}% %{props.record.location_zip}%
</template>
<template slot="quotes" slot-scope="props">
    @include('partials.components.quoterequest.circles')
</template>
<template slot="go_live_date" slot-scope="props">
    %{Functions.isNotEmpty(props.record.go_live_date) ? Formatters.dateFromServer(props.record.go_live_date) : ''}%
</template>