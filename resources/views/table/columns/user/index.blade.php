<template slot="last_name" slot-scope="props">
    <vue-link
        :endpoint="Routes.user.edit"
        :params="[props.record.id]"
    >%{props.record.name}%</vue-link>
</template>
<template slot="role_id" slot-scope="props">
    %{props.record.role.display_name}%
</template>