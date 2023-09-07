<template>
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="mb-2">{{ __('main.follow_instagram_title') }}</h2>
                    <p class="mb-5">@ {{ $page.props.settings.social_networks.instagram.login }}</p>
                </div>
            </div>
            <!-- instafeed -->
            <!-- <div class="row" id="instafeed" data-userId="4044026246" data-accessToken="4044026246.1677ed0.8896752506ed4402a0519d23b8f50a17"></div> -->
            <!-- for linking to instagram, just uncomment this line and change data-userid with your instagram user id andata-accesstoken with your instagram access token -->

            <!-- without instagram image -->
            <!-- remove this section after link with your instagram account -->
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                    <div class="instagram-post mx-2"><img
class="img-fluid w-100"
                                                          :src="asset('images/item-1.png')"
                                                          alt="instagram-image">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                class="ti-heart mr-2"></i>40</a></li>
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                class="ti-comments mr-2"></i>24</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                    <div class="instagram-post mx-2"><img
class="img-fluid w-100"
                                                          :src="asset('images/item-2.png')"
                                                          alt="instagram-image">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                class="ti-heart mr-2"></i>65</a></li>
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                class="ti-comments mr-2"></i>11</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                    <div class="instagram-post mx-2"><img
class="img-fluid w-100"
                                                          :src="asset('images/item-3.png')"
                                                          alt="instagram-image">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                class="ti-heart mr-2"></i>33</a></li>
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                class="ti-comments mr-2"></i>78</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                    <div class="instagram-post mx-2"><img
class="img-fluid w-100"
                                                          :src="asset('images/item-4.png')"
                                                          alt="instagram-image">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                class="ti-heart mr-2"></i>32</a></li>
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                class="ti-comments mr-2"></i>77</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                    <div class="instagram-post mx-2"><img
class="img-fluid w-100"
                                                          :src="asset('images/item-5.png')"
                                                          alt="instagram-image">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                class="ti-heart mr-2"></i>80</a></li>
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                class="ti-comments mr-2"></i>38</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4">
                    <div class="instagram-post mx-2"><img
class="img-fluid w-100"
                                                          :src="asset('images/item-6.png')"
                                                          alt="instagram-image">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                class="ti-heart mr-2"></i>22</a></li>
                            <li class="list-inline-item"><a href="#" target="_blank" class="text-white"><i
                                class="ti-comments mr-2"></i>57</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /without instagram image -->
        </div>
    </section>
</template>

<script>
export default {
    name: "SectionInstagram"
}
</script>

<style scoped>

</style>
