<template>
    <div class="col-md-12">
        <div v-if="isLoading">
            <div class="half-circle-spinner">
                <div class="circle circle-1"></div>
                <div class="circle circle-2"></div>
            </div>
        </div>

        <div v-if="!isLoading" class="relative">
            <div v-carousel v-bind:id="id" id="super-deals-slider" class="product_slider carousel_slider owl-carousel owl-theme nav_style3"
                data-loop="false" data-dots="false" data-nav="false" data-margin="30"
                data-responsive='{"0":{"items": "1"}, "650":{"items": "3"}, "1199":{"items": "4"}}'>
                <div class="item" v-for="item in data" :key="item.id" v-if="data.length" v-html="item" v-countDown>
                </div>
            </div>

            <!-- Custom Navigation Buttons -->
            <button @click="scrollLeft"
                class="absolute top-1/2 -translate-y-1/2 left-0 z-10 bg-white w-10 h-10 rounded-full shadow hidden md:block hover:bg-gray-100 transition-colors">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button @click="scrollRight"
                class="absolute top-1/2 -translate-y-1/2 right-0 z-10 bg-white w-10 h-10 rounded-full shadow hidden md:block hover:bg-gray-100 transition-colors">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        // alert('data');
        return {
            isLoading: true,
            data: []
        };
    },
    props: {
        url: {
            type: String,
            default: () => null,
            required: true
        },
        id: {
            type: String,
            default: () => null,
        },
    },
    mounted() {
        this.getProducts();
    },
    updated() {
        // Initialize after DOM updates
        if (!this.isLoading && this.data.length) {
        }
    },
    methods: {
        getProducts() {
            this.data = [];
            this.isLoading = true;
            axios.get(this.url)
                .then(res => {
                    this.data = res.data.data ? res.data.data : [];
                    this.isLoading = false;
                })
                .catch(res => {
                    this.isLoading = false;
                    console.log(res);
                });
        },
        scrollLeft() {
            $("#super-deals-slider").trigger('prev.owl.carousel');
        },
        scrollRight() {
            $("#super-deals-slider").trigger('next.owl.carousel');
        }
    }
}
</script>