<div
    :class="{'m-top': !noMargins}"
>
    <div
        v-for="record in shownRecords"
        class="panel panel-default"
        :class="Functions.isFunction(rows.class) ? rows.class(record) : false"
    >
        <div
            v-for="(column, field) in columns.shown"
            class="panel-body"
        >
            <div
                v-if="column.show"
                class="row"
            >
                <div
                    :style="Functions.isNotUndefined(column.style) ? column.style : ''"
                    class="col-xs-12"
                >
                    <template v-if="Functions.isNotUndefined($scopedSlots[field])">
                        <slot
                            :name="field"
                            :field="field"
                            :record="record"
                            :data="data"
                        ></slot>
                    </template>
                </div>
            </div>
        </div>
    </div>
    <div
        v-if="Functions.isEmpty(shownRecords)"
        class="panel panel-default"
        :class="Functions.isFunction(rows.class) ? rows.class(record) : false"
    >
        <div
            v-for="(column, field) in columns.shown"
            class="panel-body"
        >
            <em v-if="Functions.isNotEmpty(filters.search)">There are no records matching "%{filters.search}%".</em>
            <em v-else>There are no records.</em>
        </div>
    </div>
</div>