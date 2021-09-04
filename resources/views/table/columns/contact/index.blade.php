<template slot="first_name" slot-scope="props">
    <vue-link
        :endpoint="Routes.customer.details"
        :params="[props.record.customer_id, Routes.contact.edit, props.record.id]"
    >%{props.record.first_name}%</vue-link>
</template>