<template slot="name" slot-scope="props">
    <vue-link
        :endpoint="Routes.customer.details"
        :params="[props.record.id]"
    >
        %{props.record.name}%
        <template v-if="props.record.isProspect">
            <span class="text-muted">(Prospect)</span>
        </template>
    </vue-link>
</template>
<template slot="customer_types" slot-scope="props">
    %{props.record.customer_types.join(' | ')}%
</template>
<template slot="user_name" slot-scope="props">
    <chosen-select v-model="props.record.user_id" @input="updateAccountManager(props.record.id, $event)">
        <option
            v-for="user in config.table.data.assignableUsers"
            :value="user.id"
        >%{user.name}%</option>
    </chosen-select>
</template>
<template slot="updated_at" slot-scope="props">
    <span>%{Formatters.dateFromServer(props.record.updated_at)}%</span><br>
    <span class="small">%{Formatters.timeFromServer(props.record.updated_at)}%</span>
</template>