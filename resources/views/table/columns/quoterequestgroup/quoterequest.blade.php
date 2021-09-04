<template slot="header">Quotes</template>
<template slot="id" slot-scope="props">
    <vue-status-circle :status="props.record.status"></vue-status-circle>
    <span>
        <vue-link
            :endpoint="Routes.quoteRequest.details"
            :params="[props.record.id]"
        >%{props.record.quote_request_number}%</vue-link>
    </span>
    {{-- <br><span class="small">%{props.record.status}%</span> --}}
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
<template slot="location_address" slot-scope="props">
    %{props.record.location_address_one}%
    <template v-if="props.record.location_address_two">
        <br />%{props.record.location_address_two}%
    </template>
    <br />%{props.record.location_city}%, %{props.record.location_state}% %{props.record.location_zip}%
</template>
<template slot="quotes" slot-scope="props">
    @include('partials.components.quoterequest.circles')
</template>