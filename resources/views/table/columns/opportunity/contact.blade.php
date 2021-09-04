<template slot="name" slot-scope="props">
    %{props.record.first_name}% %{props.record.last_name}%
</template>
<template slot="email" slot-scope="props">
    %{props.record.email}%
</template>
<template slot="phone_office" slot-scope="props">
    <span v-if="Functions.isNotEmpty(props.record.phone_office)">
        %{props.record.phone_office}% (office)
    </span>
    <span v-if="Functions.isNotEmpty(props.record.phone_cell)">
        %{props.record.phone_cell}% (cell)
    </span>
</template>
