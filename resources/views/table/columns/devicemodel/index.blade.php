<template slot="model" slot-scope="props">
    <span>
        <vue-link
            :endpoint="Routes.deviceModel.edit"
            :params="[props.record.id]"
        >%{props.record.model}%</vue-link>
    </span>
</template>
