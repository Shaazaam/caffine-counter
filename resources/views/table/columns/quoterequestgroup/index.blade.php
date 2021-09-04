<template slot="id" slot-scope="props">
    {{-- <vue-status-circle :status="props.record.status"></vue-status-circle> --}}
    <span>
        <vue-link
            :endpoint="Routes.quoteRequestGroup.details"
            :params="[props.record.id]"
        >%{props.record.quote_request_group_number}%</vue-link>
    </span>
    {{-- <br><span class="small">%{props.record.status}%</span> --}}
</template>
@if (!Auth::user()->isCustomer())
    <template slot="customer_name" slot-scope="props">
        <vue-link
            :endpoint="Routes.customer.details"
            :params="[props.record.customer_id]"
        >%{props.record.customer_name}%</vue-link>
    </template>
@endif
<template slot="quote_requests" slot-scope="props">
    <template v-for="qr in getQuoteRequestArray(props.record)">
        <vue-status-circle :status="qr.status"></vue-status-circle>
        <vue-link
            :endpoint="Routes.quoteRequest.details"
            :params="[qr.id]"
        >%{qr.num}%</vue-link>
        <br>
    </template>
</template>
