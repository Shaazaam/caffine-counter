@include('partials.components.table.pagination')

@push('templates')
<template id="templateTable">
    <div class="row">
        <div class="col-xs-12">
            <p
                v-if="!Functions.isUndefined($slots.header)"
                class="bold text-muted"
            >
                <slot name="header"></slot>
            </p>

            <template v-if="isPanel && isLoading">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </template>

            <template v-else>
                <template v-if="isPanel">
                    @include('partials.components.table.panel-table')
                </template>
                <template v-else>
                    @include('partials.components.table.standard-table')
                </template>
                <slot name="footer"></slot>
                <vue-pagination
                    :page="page"
                    :pages="pages"
                    :displayed-pages="displayedPages"
                    :page-info="pageInfo"
                    @next="next"
                    @previous="previous"
                    @set-page="setPage"
                ></vue-pagination>
            </template>
        </div>
    </div>
</template>
@endpush