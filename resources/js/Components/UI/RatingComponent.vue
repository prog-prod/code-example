<template>
    <div>
        <Modal v-model="showLeaveReviewModal" size="md">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center mb-4 mt-5">
                            {{
                                __('product.testimonial.modal.reviews.title', {
                                    item: product.name,
                                })
                            }}
                        </h3>
                    </div>
                    <div class="col-12">
                        <form
                            :action="route('products.add-review', product.id)"
                        >
                            <div
                                class="d-flex align-items-center justify-content-center"
                            >
                                <star-rating
                                    v-model:rating="reviewData.rating"
                                    :increment="0.1"
                                    :star-size="25"
                                    :max-rating="5"
                                    active-color="#ffba00"
                                    :show-rating="false"
                                    @update:rating="setReviewData"
                                ></star-rating>
                            </div>
                            <div class="form-group">
                                <label for="reviewText">{{ __('product.review-data.text') }}</label
                                ><textarea
                                id="reviewText"
                                v-model="reviewData.body"
                                :placeholder="__('product.review-data.text-placeholder')"
                                name="body"
                                class="form-control"
                            />
                            </div>
                            <div
                                class="p-4 d-flex justify-content-between"
                            >
                                <a
                                    href=""
                                    class="btn btn-dark"
                                    @click.prevent="hideModal"
                                >{{ __('product.review-data.btn.back') }}</a>
                                <a
                                    href=""
                                    class="btn btn-primary"
                                    @click.prevent="sendReview"
                                >{{ __('product.review-data.btn.send') }}</a
                                >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </Modal>
        <ul class="list-inline mb-4">
            <li v-if="product.reviews.length > 0" class="list-inline-item mx-0">
                <star-rating
                    v-model:rating="rating"
                    :read-only="true"
                    :increment="0.1"
                    :star-size="15"
                    :max-rating="5"
                    active-color="#ffba00"
                    :show-rating="false"
                ></star-rating>
            </li>
            <li v-if="product.reviews.length > 0" class="list-inline-item">
                <a v-if="anchor" :href="anchor" class="text-gray ml-3">
                    ( {{ product.reviews.length }}
                    {{ __('product.details.rating.reviews') }} )
                </a>
                <span v-else class="text-gray ml-3">
                    ( {{ product.reviews.length }}
                    {{ __('product.details.rating.reviews') }} )
                </span>
            </li>
            <li>
                <a
                    class="goods-tile__reviews-link"
                    href=""
                    @click.prevent="showModal"
                ><i class="ti ti-comment text-muted"></i>
                    {{ __('product.leave_review') }}</a
                >
            </li>
        </ul>
    </div>
</template>

<script>
import StarRating from 'vue-star-rating';
import Modal from '@/Components/UI/Modal.vue';
import {useForm} from '@inertiajs/vue3';

export default {
    name: 'RatingComponent',
    components: {
        StarRating,
        Modal,
    },
    props: {
        anchor: {
            default: '',
            type: String,
        },
        product: Object,
    },
    data: function() {
        return {
            rating: 0,
            reviewData: useForm({
                rating: 0,
                body: null,
            }),
            showLeaveReviewModal: false,
        };
    },
    mounted() {
        this.rating = this.product.avg_rating;
    },
    methods: {
        sendReview() {
            this.$request.send('post', route('products.add-review', this.product.id), this.reviewData.data(), {
                onFinish: () => {
                    this.hideModal();
                    this.reviewData.reset();
                    this.notifySuccess(this.__('messages.success'));
                },
            });
        },
        showModal() {
            if (this.$page.props.auth.user) {
                this.showLeaveReviewModal = true;
            } else {
                this.$request.send('get', this.route('login'), {from: location.href});
            }
        },
        hideModal() {
            this.showLeaveReviewModal = false;
        },
        setReviewData: function(rating) {
            this.reviewData.rating = rating;
        },
        setRating: function(rating) {
            this.rating = rating;
        },
    },
};
</script>

<style scoped></style>
