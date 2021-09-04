<table
    class="table table-bordered table-striped"
    :class="{
        'm-top': !noMargins,
        'word-break': wordBreak,
    }"
>
    <thead>
        <tr>
            {{-- TODO: sigh --}}
            <th v-if="rows.areSelectable
                    && Role.isInternalManager()
            ">
                <input
                    type="checkbox"
                    v-model="selectAll"
                    :indeterminate.prop="selectAllIndeterminate"
                >
            </th>
            <template v-for="(column, field) in columns.shown">
                <th v-if="column.show">
                    %{column.header}%
                    <a
                        v-if="column.sort"
                        href="#!"
                        @click="setSortFilter(field)"
                    >
                        <span
                            class="fa pull-right"
                            :class="{
                                'fa-sort-up': isSortedAsc(field),
                                'fa-sort-down': isSortedDesc(field),
                                'fa-sort': !isFieldSorted(field)
                            }"
                        ></span>
                    </a>
                </th>
            </template>
        </tr>
    </thead>
    <tbody>
        <template v-if="isLoading">
            <tr>
                <td
                    :colspan="Object.keys(columns.shown).length"
                    align="middle"
                >
                    <div class="text-center">
                        <i class="fa fa-spinner fa-pulse fa-fw"></i> Loading...
                    </div>
                </td>
            </tr>
        </template>
        <template v-else-if="Functions.isEmpty(shownRecords)">
            <tr>
                <td
                    :colspan="Object.keys(columns.shown).length + (rows.areSelectable ? 1 : 0)"
                    align="middle"
                >
                    <template>
                        <em v-if="Functions.isNotEmpty(filters.search)">There are no records matching "%{filters.search}%".</em>
                        <em v-else>There are no records.</em>
                    </template>
                </td>
            </tr>
        </template>
        <template v-else>
            <tr
                v-for="record in shownRecords"
                :class="Functions.isFunction(rows.class) ? rows.class(record) : false"
            >
               {{-- TODO: no --}}
                <td v-if="rows.areSelectable
                    && Role.isInternalManager()
                ">
                    <input
                        type="checkbox"
                        v-model="selectedRecords"
                        :value="record"
                    >
                </td>
                <template v-for="(column, field) in columns.shown">
                    <template v-if="column.show">
                        <td :style="Functions.isNotUndefined(column.style) ? column.style : ''">
                            <template v-if="Functions.isNotUndefined($scopedSlots[field])">
                                <slot
                                    :name="field"
                                    :field="field"
                                    :record="record"
                                    :data="data"
                                ></slot>
                            </template>
                            <template v-else>
                                %{record[field]}%
                            </template>
                        </td>
                    </template>
                </template>
            </tr>
        </template>
    </tbody>
</table>