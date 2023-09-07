<template>
    <div>
        <Head title="Dashboard"/>
        <section class="user-dashboard section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <DashboardMenu/>
                        <div class="dashboard-wrapper user-dashboard">
                            <div class="media">
                                <div class="pull-left mr-3">
                                    <img
                                        class="media-object user-img" :src="asset('images/user.png')"
                                        alt="Image">
                                </div>
                                <div class="media-body align-self-center">
                                    <h2 class="media-heading">Welcome {{ user.name }}</h2>
                                    <a
                                        target="_blank"
                                        class="telegram-tracking telegram-tracking__bottom"
                                        href="https://t.me/my_bot">
                                        <div class="telegram-tracking__banner">
                                            <div class="telegram-tracking__banner-title">
                                                <img
                                                    alt="" aria-hidden="true"
                                                    class="telegram-tracking__banner-img"
                                                    src="https://xl-static.rozetka.com.ua/assets/img/design/telegram-banner.svg">
                                                <div class="telegram-tracking__title">
                                                    Отримуйте сповіщення про замовлення та спілкуйтеся з Printopia у
                                                    нашому Telegram-боті
                                                </div>
                                            </div>
                                            <div
                                                class="button button--medium button--red button--width telegram-tracking__button">
                                                Підписатись
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="total-order mt-4">
                                <h4>Total Orders</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <th>Items</th>
                                            <th>Total Price</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><a href="/dashboard#">#252125</a></td>
                                            <td>Mar 25, 2016</td>
                                            <td>2</td>
                                            <td>$ 99.00</td>
                                        </tr>
                                        <tr>
                                            <td><a href="/dashboard#">#252125</a></td>
                                            <td>Mar 25, 2016</td>
                                            <td>2</td>
                                            <td>$ 99.00</td>
                                        </tr>
                                        <tr>
                                            <td><a href="/dashboard#">#252125</a></td>
                                            <td>Mar 25, 2016</td>
                                            <td>2</td>
                                            <td>$ 99.00</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import DashboardMenu from '@/Components/Profile/DashboardMenu.vue';
import profile from '@/Mixins/profile.js';

export default {
    components: {
        DashboardMenu,
    },
    mixins: [profile],
    layout: [BaseLayout],
};
</script>

<style lang="scss" scoped>
@import "@/../sass/_variables.scss";

.telegram-tracking__bottom {
    margin-bottom: 16px;
}

@media (min-width: 768px) {
    .telegram-tracking {
        gap: 16px;
        padding: 16px;
    }
}

.telegram-tracking {
    background-color: rgba(#43c2f6, 0.1);
    border-radius: 8px;
    color: #221f1f;
    display: flex;
    flex-direction: row;
    justify-content: center;
    gap: 8px;
}

.telegram-tracking__banner {
    padding: 12px 16px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    align-items: center;
}

.telegram-tracking__banner-title {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 16px;
    justify-content: center;
    max-width: 600px;
}

@media (min-width: 768px) {
    .telegram-tracking__banner {
        flex-direction: row;
    }
}

.telegram-tracking__banner-img {
    min-width: 40px;
}

@media (min-width: 768px) {
    .telegram-tracking__banner-img {
        min-width: 56px;
    }
}

.telegram-tracking__title {
    font-size: 16px;
}

@media (min-width: 768px) {
    .telegram-tracking__title {
        font-size: 20px;
        text-align: center;
    }
}

.button--red {
    background-color: $primary;
    color: #fff;
}

.button--medium, .button_size_medium {
    font-size: 16px;
    height: 40px;
    line-height: 40px;
}

.button {
    display: inline-block;
    border: none;
    border-radius: 8px;
    box-sizing: border-box;
    display: inline-block;
    font-family: Rozetka, BlinkMacSystemFont, -apple-system, Arial, Segoe UI, Roboto, Helvetica, sans-serif;
    margin: 0;
    outline: none;
    padding-left: 16px;
    padding-right: 16px;
    position: relative;
    text-align: center;
    transition-duration: .2s;
    transition-property: color, background-color, border-color;
    transition-timing-function: ease-in-out;
}


</style>
