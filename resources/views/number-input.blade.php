@push('templates')
<template id="templateNumberInput">
    <imask-input
        v-model="input"
        class="form-control"
        :mask="Number"
        :prepare="prepare"
        :scale="precision"
        :min="min"
        :max="max"
        :map-to-radix="['.']"
        :pad-fractional-zeros="precision > 0"
        :signed="signed"
        radix="."
        unmask="typed"
        thousands-separator=","
        overwrite
    ></imask-input>
</template>
@endpush