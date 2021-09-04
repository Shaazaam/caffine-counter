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
<template slot="quotes" slot-scope="props">
    @include('partials.components.quoterequest.circles')
</template>
<template slot="go_live_date" slot-scope="props">
    %{Functions.isNotNull(props.record.go_live_date) ? Formatters.dateFromServer(props.record.go_live_date) : ''}%
</template>