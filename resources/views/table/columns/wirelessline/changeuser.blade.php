<template slot="select" slot-scope="props">
    <button
        type="button"
        class="btn btn-link"
        data-toggle="modal"
        data-target="#changeWirelessUser"
        @click="changeUserTo(props.record)"
    >Select</button>
</template>
<template slot="name" slot-scope="props">
    %{props.record.name_first}% %{props.record.name_last}%
</template>
