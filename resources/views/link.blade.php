@push('templates')
<template id="templateLink">
    <a :href="Factory.newRoute(endpoint, params)"><slot></slot></a>
</template>
@endpush