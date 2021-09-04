<template slot="name" slot-scope="props">
    <vue-link
        :endpoint="Routes.container.edit"
        :params="[props.record.id]"
    >
        %{props.record.name}%
    </vue-link>
</template>
<template slot="customer_name" slot-scope="props">
    <vue-link
        :endpoint="Routes.customer.details"
        :params="[props.record.customer_id]"
    >%{props.record.customer_name}%</vue-link>
</template>
<template slot="type" slot-scope="props">
    %{Formatters.colloquialize(props.record.type)}%
</template>