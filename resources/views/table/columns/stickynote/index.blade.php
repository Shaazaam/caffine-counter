<template slot="id" slot-scope="props">
    <vue-link
        :endpoint="Routes[props.record.type].details"
        :params="[props.record.module_id]"
    >
        %{props.record.module_resource_number}% - %{props.record.module_name}%
    </vue-link>
</template>
<template slot="note" slot-scope="props">
    <span class="pull-left">
        %{props.record.note}%
    </span>
    <button
        type="button"
        class="btn btn-link pull-right"
        @click="remove(props.record.id)"
    >
        <span class="fa fa-trash text-danger"></span>
    </button>
</template>