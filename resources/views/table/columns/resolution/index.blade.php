<template slot="code" slot-scope="props">
    <span>
        <vue-link
            :endpoint="Routes.resolution.edit"
            :params="[props.record.id]"
        >%{props.record.code}%</vue-link>
    </span>
</template>
<template slot="resolution_types" slot-scope="props">
    %{props.record.resolution_types.join(' | ')}%
</template>