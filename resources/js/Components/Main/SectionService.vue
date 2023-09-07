<template>
    <section class="section-sm border-top">
        <div class="container">
            <div class="row">
                <!-- service item -->
                <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                    <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
                        <i class="ti-truck icon-lg mr-4 mb-3 mb-sm-0"></i>
                        <div class="text-center text-sm-left">
                            <h4>{{ __("main.free_shipping_title") }}</h4>
                            <p class="mb-0 text-gray">{{ __("main.free_shipping_description") }}</p>
                        </div>
                    </div>
                </div>
                <!-- service item -->
                <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                    <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
                        <i class="ti-shield icon-lg mr-4 mb-3 mb-sm-0"></i>
                        <div class="text-center text-sm-left">
                            <h4>{{ __("main.secure_payment") }}</h4>
                            <p class="mb-0 text-gray">{{ __("main.secure_payment_description") }}</p>
                        </div>
                    </div>
                </div>
                <!-- service item -->
                <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                    <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
                        <i class="ti-timer icon-lg mr-4 mb-3 mb-sm-0"></i>
                        <div class="text-center text-sm-left">
                            <h4>{{ __("main.support") }}</h4>
                            <p class="mb-0 text-gray">{{ __("main.support_description") }}</p>
                        </div>
                    </div>
                </div>
                <!-- service item -->
                <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                    <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
                        <i class="ti-reload icon-lg mr-4 mb-3 mb-sm-0"></i>
                        <div class="text-center text-sm-left">
                            <h4>{{ __("main.return_policy") }}</h4>
                            <p class="mb-0 text-gray">{{ __("main.return_policy_description") }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "SectionService"
}
</script>

<style scoped>

</style>
