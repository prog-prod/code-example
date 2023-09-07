<template>
    <div class="header-actions">
        <button id="searchOpen" class="header-actions__btn"><i class="ti-search"></i></button>
        <div class="search-wrapper">
            <form action="#" @submit.prevent="search">
                <input
                    id="search" v-model="form.searchText" class="search-box" type="search"
                    :placeholder="__('header.search.placeholder')">
                <button class="search-icon" type="submit"><i class="ti-search"></i></button>
            </form>
        </div>
    </div>

</template>

<script>
import {useForm} from '@inertiajs/vue3';

export default {
    name: 'NavigationSearch',
    data: () => ({
        form: useForm({
            searchText: null,
        }),
    }),
    mounted() {
        $('#searchOpen').on('click', function() {
            const wrapper = $('.search-wrapper');
            wrapper.toggleClass('open');
            if (wrapper.hasClass('open')) {
                $(this).find('i').removeClass('ti-search').addClass('ti-close');
            } else {
                $(this).find('i').addClass('ti-search').removeClass('ti-close');
            }
        });
    },
    methods: {
        search() {
            this.$search.search(this.form.searchText, false, {
                onFinish: () => {
                    this.form.reset();
                    $('#searchOpen').click();
                },
            });
        },
    },
};
</script>

<style scoped>

</style>
