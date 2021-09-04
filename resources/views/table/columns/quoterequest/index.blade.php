<template slot="id" slot-scope="props">
    <vue-status-circle :status="props.record.status"></vue-status-circle>
    <span>
        <vue-link
            :endpoint="Routes.quoteRequest.details"
            :params="[props.record.id]"
        >%{props.record.quote_request_number}%</vue-link>
    </span>
    <br><span class="small">%{props.record.status}%</span>
</template>
<template slot="customer_name" slot-scope="props">
    <vue-link
        :endpoint="Routes.customer.details"
        :params="[props.record.customer_id]"
    >%{props.record.customer_name}%</vue-link>
</template>
<template slot="requester_id" slot-scope="props">
    %{props.record.requester_name}%
</template>
<template slot="service" slot-scope="props">
    <template v-if="Functions.isNotEmpty(props.record.service)">
        <template v-for="(service, index) in props.record.service.split(',')">
            %{service}%
            <br v-if="props.record.service.split(',').length - 1 !== index">
        </template>
    </template>
</template>
<template slot="location_name" slot-scope="props">
    <vue-status-circle :status="props.record.location_status"></vue-status-circle>
    <span>
        <vue-link
            :endpoint="Routes.location.details"
            :params="[props.record.location_id]"
        >%{props.record.location_name}%</vue-link>
    </span>
</template>
<template slot="location_address_one" slot-scope="props">
    %{props.record.location_address_one}%
    <template v-if="props.record.location_address_two">
        <br />%{props.record.location_address_two}%
    </template>
    <br />%{props.record.location_city}%, %{props.record.location_state}% %{props.record.location_zip}%
</template>
<template slot="go_live_date" slot-scope="props">
    <span v-if="Functions.isNotNull(props.record.go_live_date)">%{props.record.go_live_date}%</span>
    <span v-else>N/A</span>
</template>
<template slot="quotes_blue" slot-scope="props">
    @include('partials.components.quoterequest.circles')
</template>