@include('partials.components.notification.table-base')

<template slot="id" slot-scope="props">
    <component
        :is="Notifications[props.record.type].tableComponent"
        :notification="props.record"
        @remove="remove"
    ></component>
</template>