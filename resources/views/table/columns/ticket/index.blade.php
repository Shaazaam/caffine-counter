<template slot="id" slot-scope="props">
    <span class="fa" :class="[Formatters.getIconForStatus(props.record.status), Formatters.stripSpaces(props.record.status)]"></span>
    <span>
        <vue-link
            :endpoint="Routes.ticket.details"
            :params="[props.record.ticket_id]"
        >%{props.record.resource_number}%</vue-link>
    </span>
    <br>
    <span class="small">%{props.record.status}%</span>
    <span
        v-if="Functions.isNotNull(props.record.major_incident_id)"
        class="fa fa-link pull-right"
        v-tooltip="'#' + props.record.major_incident_number"
    ></span>
</template>
<template slot="typeable_type" slot-scope="props">
    %{Formatters.colloquialize(props.record.typeable_type)}%
</template>
<template slot="sub_type" slot-scope="props">
    %{Formatters.colloquialize(props.record.sub_type)}%
</template>
<template slot="customer_name" slot-scope="props">
    <vue-link
        :endpoint="Routes.customer.details"
        :params="[props.record.customer_id]"
    >%{props.record.customer_name}%</vue-link>
</template>
<template slot="location_name" slot-scope="props">
    <template v-if="Functions.isNotNull(props.record.location_id)">
        <span class="fa" :class="[Formatters.getIconForStatus(props.record.location_status), Formatters.stripSpaces(props.record.location_status)]"></span>
        <span v-if="!(Role.isWireless() || Role.isCustomerLimited())">
            <vue-link
                :endpoint="Routes.location.details"
                :params="[props.record.location_id]"
            >%{props.record.location_name}%</vue-link>
        </span>
        <span v-else>
            %{props.record.location_name}%
        </span>
        <br>
        <span class="small">%{props.record.location_status}%</span><br />
        <span class="small">Cust. Loc. # %{props.record.location_oracle_number}%</span>
    </template>
    <template v-else-if="Functions.isNull(props.record.location_id) && props.record.isWireless">
        <em v-tooltip:bottom="'Unavailable on a wireless ticket'">N/A</em>
    </template>
</template>
<template slot="order_id" slot-scope="props">
    <template v-if="Functions.isNotNull(props.record.order_id)">
        <span class="fa" :class="[Formatters.getIconForStatus(props.record.order_status), Formatters.stripSpaces(props.record.order_status)]"></span>
        <span v-if="!(Role.isWireless() || Role.isCustomerLimited())">
            <vue-link
                :endpoint="Routes.order.details"
                :params="[props.record.order_id]"
            >%{props.record.service_name}%</vue-link>
        </span>
        <span v-else>
            %{props.record.service_name}%
        </span>
        <br>
        <span class="small">%{props.record.order_work_order_number}%</span>
    </template>
    <template v-else-if="Functions.isNull(props.record.order_id) && props.record.isWireless">
        <em v-tooltip:bottom="'Unavailable on a wireless ticket'">N/A</em>
    </template>
</template>
<template slot="wireless_account_id" slot-scope="props">
    <template v-if="Functions.isNotNull(props.record.wireless_account_id)">
        <span>
            <vue-link
                :endpoint="Routes.wirelessAccount.details"
                :params="[props.record.wireless_account_id]"
            >%{props.record.wireless_account_name}%</vue-link>
        </span>
    </template>
    <template v-else-if="Functions.isNull(props.record.wireless_account_id) && props.record.isWired">
        <em v-tooltip:bottom="'Unavailable on a wired ticket'">N/A</em>
    </template>
</template>
<template slot="wireless_lines" slot-scope="props">
    <template v-if="Functions.isNotEmpty(props.record.wireless_lines)">
        <span v-for="wireless_line in props.record.wireless_lines">
            <vue-link
                :endpoint="Routes.wirelessLine.details"
                :params="[wireless_line.id_text]"
            >%{wireless_line.phone_number}%</vue-link>
            <br>
        </span>
    </template>
    <template v-else-if="Functions.isEmpty(props.record.wireless_lines) && props.record.isWired">
        <em v-tooltip:bottom="'Unavailable on a wired ticket'">N/A</em>
    </template>
</template>
<template slot="wireless_user_id" slot-scope="props">
    <template v-if="Functions.isNotNull(props.record.wireless_user_id)">
        <span>
            <vue-link
                :endpoint="Routes.wirelessUser.details"
                :params="[props.record.wireless_user_id]"
            >%{props.record.wireless_user_name}%</vue-link>
        </span>
    </template>
    <template v-else-if="Functions.isNull(props.record.wireless_user_id) && props.record.isWired">
        <em v-tooltip:bottom="'Unavailable on a wired ticket'">N/A</em>
    </template>
</template>
<template slot="priority" slot-scope="props">
    %{Formatters.getPriorityText(props.record.priority)}%
</template>
<template slot="primary_name" slot-scope="props">
    %{props.record.primary_name}%
    <template v-if="Functions.isNotEmpty(props.record.primary_phone_number)">
        <br>
        <span class="small">
            %{props.record.primary_phone_number}%
            <template v-if="Functions.isNotEmpty(props.record.primary_phone_number_extension)">
                ext. %{props.record.primary_phone_number_extension}%
            </template>
        </span>
    </template>
    <template v-if="Functions.isNotEmpty(props.record.primary_email)">
        <br>
        <span class="small">%{props.record.primary_email}%</span>
    </template>
</template>
<template slot="local_name" slot-scope="props">
    %{props.record.local_name}%
    <template v-if="Functions.isNotEmpty(props.record.local_phone_number)">
        <br>
        <span class="small">
            %{props.record.local_phone_number}%
            <template v-if="Functions.isNotEmpty(props.record.local_phone_number_extension)">
                ext. %{props.record.local_phone_number_extension}%
            </template>
        </span>
    </template>
    <template v-if="Functions.isNotEmpty(props.record.local_email)">
        <br>
        <span class="small">%{props.record.local_email}%</span>
    </template>
</template>
<template slot="can_bill" slot-scope="props">
    <span class="fa fa-check"></span>
</template>
<template slot="user_name" slot-scope="props">
    {{-- Auth::user()->canAssign() --}}
    <template v-if="(Role.isHelpDesk() || Role.isSuperAdmin() || Role.isWirelessAdmin()) && props.record.status !== 'Closed'">
        <assign-user
            :id="props.record.ticket_id"
            :model="props.record"
            resource="ticket"
            :users="assignableUsersBySelectedGroup(props.record.container_id)"
            @input="setUser"
            @done="assignDone"
            @fail="fail"
            @always="always"
        ></assign-user>
    </template>
    <template v-else>
        %{props.record.user_name}%
    </template>
</template>
<template slot="group_name" slot-scope="props">
    {{-- Auth::user()->canAssign() --}}
    <template v-if="(Role.isHelpDesk() || Role.isSuperAdmin() || Role.isWirelessAdmin()) && props.record.status !== 'Closed'">
        <assign-user
            :id="props.record.ticket_id"
            :model="props.record"
            resource="ticket"
            :users="props.data.groups"
            property="container_id"
            endpoint="assignGroup"
            @input="setGroup"
            @done="assignDone"
            @fail="fail"
            @always="always"
        ></assign-user>
    </template>
    <template v-else>
        %{props.record.group_name}%
    </template>
</template>
<template slot="resolution_code" slot-scope="props" v-if="Functions.isNotNull(props.record.resolution_id)">
    %{props.record.resolution_code}%
</template>
<template slot="created_at" slot-scope="props">
    <span>%{Formatters.dateFromServer(props.record.created_at)}%</span>
    <br>
    <span class="small">%{Formatters.timeFromServer(props.record.created_at)}%</span>
</template>
<template slot="updated_at" slot-scope="props">
    <span>%{Formatters.dateFromServer(props.record.updated_at)}%</span>
    <br>
    <span class="small">%{Formatters.timeFromServer(props.record.updated_at)}%</span>
</template>
<template slot="solved_on" slot-scope="props">
    <span>%{Functions.isNotNull(props.record.solved_on) ? Formatters.dateFromServer(props.record.solved_on) : ''}%</span>
    <br>
    <span class="small">%{Functions.isNotNull(props.record.solved_on) ? Formatters.timeFromServer(props.record.solved_on) : ''}%</span>
</template>