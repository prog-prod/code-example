<template>
    <ul class="characteristic-list">
        <li class="ng-star-inserted">
            <h2 class="visible-hidden">Характеристики</h2>
            <section class="ng-star-inserted">
                <ul
                    id="comparisonCharacteristicSection1" aria-expanded="true"
                    class="ng-star-inserted">
                    <template v-for="(feature,key) in uniqueFeatures" :key="key">
                        <li class="comparison-characteristic ng-star-inserted">
                            <h3 class="comparison-characteristic__heading" style="top: 0;">{{ feature.name }}</h3>
                            <dl>
                                <div class="comparison-grid">
                                    <template v-for="(product,key2) in products" :key="key2">
                                        <div class="comparison-grid__cell ng-star-inserted">
                                            <dt class="comparison-characteristic__label">
                                                {{ product.name }}
                                            </dt>
                                            <dd class="comparison-characteristic__value">
                                        <span class="ng-star-inserted">{{
                                                getProductFeatureText(product, feature.name)
                                            }}</span>
                                            </dd>
                                        </div>
                                    </template>
                                </div>
                            </dl>
                        </li>
                    </template>
                </ul>
            </section>
        </li>
    </ul>
</template>

<script>
export default {
    name: 'ProductCharacteristics',
    props: {
        products: {
            type: Array,
            required: true,
        },
    },
    computed: {
        uniqueFeatures() {
            const uniqueFeatures = [];

            this.products.forEach(product => {
                product.features.forEach(feature => {
                    const existingFeature = uniqueFeatures.find(
                        f => f.name === feature.name,
                    );

                    if (!existingFeature) {
                        uniqueFeatures.push({
                            name: feature.name,
                            text: feature.text,
                        });
                    }
                });
            });

            return uniqueFeatures;
        },
    },
    methods: {
        getProductFeatureText(product, featureName) {
            return product.features.find(feature => feature.name === featureName)?.text || '-';
        },
    },
};
</script>

<style lang="scss" scoped>
.visible-hidden {
    display: block;
    height: 0;
    margin: 0;
    overflow: hidden;
    padding: 0;
    visibility: hidden;
    width: 0;
}

.characteristic-list {
    margin-bottom: 48px;
    width: 100%;

    .comparison-characteristic {
        padding-top: 8px;
        padding-bottom: 24px;

        .comparison-characteristic__heading {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            padding-top: 8px;
            padding-bottom: 8px;
            margin-bottom: 8px;
            background-color: #fff;
            font-size: 16px;
            font-weight: 700;
        }

        dl, dt {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        .comparison-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-row-gap: 16px;

            .comparison-grid__cell {
                padding-right: 16px;
                word-break: break-word;

                .comparison-characteristic__value {
                    font-size: 14px;

                    * {
                        display: block;
                        margin-bottom: 4px;
                    }
                }

                .comparison-characteristic__label {
                    margin-bottom: 8px;
                    font-size: 12px;
                    color: #797878;
                }
            }
        }
    }
}

</style>
