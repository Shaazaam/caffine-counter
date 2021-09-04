<template slot="id" slot-scope="props">
    <div>
        <div class="row">
            <div class="col-xs-025">
                <button
                    class="btn btn-link"
                    @click="props.record.isCollapsed = !props.record.isCollapsed"
                >
                    <span
                        class="fa"
                        :class="{
                            'fa-caret-right': props.record.isCollapsed,
                            'fa-caret-down': !props.record.isCollapsed
                        }"
                    ></span>
                </button>
            </div>
            <div class="col-xs-05">
                <span class="fa-stack fa-lg">
                    <span
                        class="fa fa-circle fa-stack-2x"
                        :class="{
                            'text-red': Functions.isEmpty(props.record.deactivated_at),
                            'text-muted': Functions.isNotEmpty(props.record.deactivated_at),
                        }"
                    ></span>
                    <span class="fa fa-bell-o fa-stack-1x text-white"></span>
                </span>
            </div>
            <div class="col-xs-85">
                %{props.record.title}%
                <template v-if="Functions.isNotNull(props.record.remindable_id)">
                    <br>
                    <vue-link
                        :endpoint="Routes[props.record.remindable_type].details"
                        :params="[props.record.remindable_id]"
                    >
                        %{Formatters.toUpperCaseWords(props.record.remindable_type)}% %{props.record.resource_number}%
                    </vue-link>
                </template>
            </div>
            <div class="col-xs-2 text-right">
                %{Formatters.timeFromServer(props.record.remind_at)}%
                <br>
                %{Formatters.date(props.record.remind_at, Dates.sql.dateTime, 'dddd MMM D, YYYY')}%
            </div>
            <div class="col-xs-025">
                <button
                    v-show="Functions.isEmpty(props.record.deactivated_at)"
                    class="btn btn-link"
                    data-toggle="modal"
                    data-target="#reminderForm"
                    @click="edit(props.record)"
                >
                    <span class="fa fa-pencil"></span>
                </button>
            </div>
            <div class="col-xs-025">
                <label v-show="Functions.isEmpty(props.record.deactivated_at)" class="checkbox-inline m-left">
                    <input
                        type="checkbox"
                        name="is_selected"
                        v-model="props.record.isSelected"
                    />
                </label>
            </div>
        </div>
        <div class="row" v-show="!props.record.isCollapsed">
            <div class="col-xs-025"></div>
            <div class="col-xs-05"></div>
            <div class="col-xs-105">
                <hr class="half-margin">
                %{props.record.description}%
            </div>
            <div class="col-xs-025"></div>
        </div>
    </div>
</template>