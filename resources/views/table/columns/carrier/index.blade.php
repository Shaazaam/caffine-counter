<template slot="name" slot-scope="props">
    <vue-link
        :endpoint="Routes.carrier.edit"
        :params="[props.record.id]"
    >%{props.record.name}%</vue-link>
</template>
<template slot="voice_services" slot-scope="props">
    <vue-font-awesome-icon v-if="props.record.voice_services" :icon="Icons.fontAwesome.check"></vue-font-awesome-icon>
</template>
<template slot="data_services" slot-scope="props">
    <vue-font-awesome-icon v-if="props.record.data_services" :icon="Icons.fontAwesome.check"></vue-font-awesome-icon>
</template>
<template slot="other_managed_services" slot-scope="props">
    <vue-font-awesome-icon v-if="props.record.other_managed_services" :icon="Icons.fontAwesome.check"></vue-font-awesome-icon>
</template>
<template slot="wireless_services" slot-scope="props">
    <vue-font-awesome-icon v-if="props.record.other_managed_services" :icon="Icons.fontAwesome.check"></vue-font-awesome-icon>
</template>
<template slot="service_type" slot-scope="props">
    %{ props.record.service_type.join(', ') }%
</template>