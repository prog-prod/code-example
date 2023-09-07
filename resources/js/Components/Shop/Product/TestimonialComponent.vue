<template>
    <!-- testimonial-item -->
    <div class="d-flex">
        <div>
            <img
                class="customer-img rounded-circle mr-4" :src="assetStorage(testimonial.user?.avatar)"
                alt="customer-img">
        </div>
        <div>
            <h5 class="customer-name text-dark">{{ testimonial.user?.name }}</h5>
            <p class="text-gray comment-date">{{ testimonial.created_at }}</p>

            <ul class="list-inline mb-2">
                <li class="list-inline-item mx-0">
                    <star-rating
                        v-model:rating="rating"
                        :read-only="true"
                        :increment="0.1"
                        :star-size="16"
                        :max-rating="5"
                        active-color="#ffba00"
                        :show-rating="false"
                        @rating-selected="setRating"
                    ></star-rating>
                </li>
            </ul>

            <h4 class="text-dark comment-text mb-4">{{ testimonial.body }}</h4>

        </div>
    </div>
</template>

<script>
import StarRating from 'vue-star-rating';

export default {
    name: 'TestimonialComponent',
    components: {
        StarRating,
    },
    props: {
        testimonial: {
            type: Object,
            required: true,
        },
    },
    data: function() {
        return {
            rating: 0,
        };
    },
    mounted() {
        this.rating = this.testimonial.rating;
        console.log(this.testimonial);
    },
    methods: {
        setRating: function(rating) {
            this.rating = rating;

        },
    },
};
</script>

<style scoped>
.customer-img {
    width: 140px;
}

.comment-text {
    margin-bottom: 16px;
    font-size: 14px;
}

.customer-name {
    position: relative;
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 0;

}

.comment-date {
    font-size: 12px;
    font-weight: 400;
    color: #a6a5a5;
    margin-bottom: 10px;
}
</style>
