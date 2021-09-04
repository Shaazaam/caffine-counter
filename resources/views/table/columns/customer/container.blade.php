<template slot="type_count" slot-scope="props">
    %{props.record.type_count}%
    <div class="checkbox pull-right">
        <input
            type="checkbox"
            v-model="containerIds"
            :value="props.record.id"
        />
    </div>
</template>