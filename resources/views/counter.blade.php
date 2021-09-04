@extends('main')
@section('body')
<div class="row" id="vm" v-cloak>
    <div class="col-xs-6 col-xs-offset-3 m-top-4">

        <div class="row">
            <div class="col-sx-12 text-center">
                <h1>Caffeine Counter</h1>
            </div>
        </div>

        <h4>This simple interface allows you to select from a list of caffeinated drinks.</h4>
        <h4>Each drink has a default serving size, but you may change the serving size.</h4>
        <h4>Your total caffeine intake will be calculated based on selected drink and servings.</h4>
        <h4>500mg is the recommended safe limit. Further consumption is at your own risk!</h4>

        <transition name="fade">
            <alert
                type="danger"
                v-if="hasErrors"
            >Error, data invalid</alert>
        </transition>
        <transition name="fade">
            <alert
                type="success"
                v-if="Functions.isNotEmpty(sharedState.message) && !hasErrors"
            >%{sharedState.message}%</alert>
        </transition>

        <form>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-4">
                            <label>Name</label>
                        </div>
                        <div class="col-xs-3">
                            <label>Serving Size</label>
                        </div>
                        <div class="col-xs-3">
                            <label>Caffeine Amount (per serving)</label>
                        </div>
                        <div class="col-xs-2 text-center"></div>
                    </div>
                </div>
                <div class="panel-body">
                    <drink
                        v-for="(drink, index) in selectedDrinks"
                        v-model="selectedDrinks[index]"
                        :key="index"
                        :errors="getErrors(index)"
                        :index="index"
                        :drinks="drinks"
                        @remove-drink="removeDrink"
                    ></drink>

                    <div v-if="Functions.isEmpty(selectedDrinks)">
                        <div class="row">
                            <div class="col-xs-12">
                                <em>There are currently no drinks selected. Click Add a Drink to get started.</em>
                            </div>
                        </div>

                        <hr class="half-margin">
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <button
                                type="button"
                                class="btn btn-info"
                                @click="addDrink"
                                :disabled="!canAddAnother"
                            >
                                Add a Drink
                            </button>

                            <button
                                v-show="Functions.isNotEmpty(selectedDrinks)"
                                type="button"
                                class="btn btn-warning"
                                @click="clear"
                            >
                                Restart
                            </button>

                            <button
                                v-show="Functions.isNotEmpty(selectedDrinks)"
                                type="button"
                                class="btn btn-primary"
                                @click="submit"
                                :disabled="sharedState.isSaving || !isValid"
                            >
                                Submit
                                <span v-if="sharedState.isSaving" class="glyphicon glyphicon-refresh spinning"></span>
                            </button>
                        </div>
                    </div>

                    <div v-if="total > 0 && Functions.isNotEmpty(selectedDrinks)">
                        <hr class="half-margin">

                        <div class="row">
                            <div class="col-xs-4 col-xs-push-8 text-right m-top">
                                <div class="row">
                                    <div class="col-xs-8 text-right">
                                        <label>Total</label>
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        %{Formatters.numberFormat(total)}%mg
                                    </div>
                                </div>
                                <div
                                    class="row"
                                    :class="{
                                        'text-red': isDead,
                                        'text-yellow': isOverSafeLimit,
                                        'text-green': isSafe,
                                    }"
                                >
                                    <div v-if="isOverSafeLimit || isSafe">
                                        <div class="col-xs-8 text-right">
                                            <label>Amount Less</label>
                                        </div>
                                        <div class="col-xs-4 text-right">
                                            %{Formatters.numberFormat(amountLess)}%mg
                                        </div>
                                    </div>
                                    <div v-else-if="isDead">
                                        <div class="col-xs-12 text-right text-red">
                                            <label>You Died</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@stop

@push('templates')
<template id="templateDrink">
    <div>
        <div class="row">
            <div class="col-xs-4" :class="errorClass(errors, 'id')">
                <select
                    name="drink"
                    id="drink"
                    class="form-control"
                    v-model="drinkId"
                    placeholder="Select a Drink"
                >
                    <option v-for="drink in drinks" :value="drink.id">%{drink.name}%</option>
                </select>
                <error-span field="id" :errors="errors"></error-span>
            </div>
            <div class="col-xs-3 text-right" :class="errorClass(errors, 'serving_size')">
                <number-input
                    v-model="drink.serving_size"
                    :integers="7"
                    :precision="0"
                    :signed="false"
                ></number-input>
                <error-span field="serving_size" :errors="errors"></error-span>
            </div>
            <div class="col-xs-3 text-right">
                <p>%{drink.caffeine_content}%mg</p>
            </div>
            <div class="col-xs-2 text-center">
                <button
                    type="button"
                    class="btn btn-sm btn-danger"
                    @click="remove"
                >Remove</button>
            </div>
        </div>

        <hr class="half-margin">
    </div>
</template>
@endpush

@include('number-input')

@push('scripts')
<script type="text/javascript" src="{{asset('src/js/instances/counter.js')}}"></script>
<script type="text/javascript">
    (() => {
        Factory.newVueInstance(VueInstances.counter, {
            el: '#vm',
            data() {
                return {
                    drinks: {!!$drinks!!},
                    // Yes, this could be given on submission, but the front end is the only thing that cares to evaluate for display
                    safeLimit: {!!$safeLimit!!},
                    lethalLimit: {!!$lethalLimit!!},
                };
            },
        });
    })();
</script>
@endpush