export default {
    computed: {
        endSaleYear() {
            return new Date(this.product.sale.endDate).getFullYear();
        },
        endSaleMonths() {
            return new Date(this.product.sale.endDate).getMonth() + 1;
        },
        endSaleDays() {
            return new Date(this.product.sale.endDate).getDate();
        },
        endSaleHours() {
            return new Date(this.product.sale.endDate).getHours();
        },
    },
};
