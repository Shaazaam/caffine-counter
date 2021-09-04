@push('templates')
<template id="templatePagination">
    <div class="row">
        <div class="col-xs-12">
            <ul class="pagination" v-if="pages > 1">
                <li
                    :class="{'disabled': page === 1}"
                    @click="previous"
                >
                    <a href="#!">
                        <span>&laquo;</span>
                    </a>
                </li>
                <li
                    v-for="n in displayedPages"
                    :class="{'disabled': Functions.isString(n), 'active': n === page}"
                    @click="setPage(n)"
                >
                    <a href="#!">%{n}%</a>
                </li>
                <li
                    :class="{'disabled': page === pages}"
                    @click="next"
                >
                    <a href="#!">
                        <span>&raquo;</span>
                    </a>
                </li>
            </ul>
            <span class="pull-right">Showing %{pageInfo.start}% - %{pageInfo.end < pageInfo.total ? pageInfo.end : pageInfo.total}% of %{pageInfo.total}%</span>
        </div>
    </div>
</template>
@endpush()