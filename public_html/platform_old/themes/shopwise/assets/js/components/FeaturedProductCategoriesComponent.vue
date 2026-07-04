<template>
    <div class="col-12">
        <div v-if="isLoading">
            <div class="half-circle-spinner">
                <div class="circle circle-1"></div>
                <div class="circle circle-2"></div>
            </div>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 md:gap-x-0 md:gap-y-4 w-full" v-if="!isLoading">
            <a class="flex items-center flex-col cursor-pointer gap-1" v-for="item in data" :href="item.url">
                <div class=" w-36 h-36 flex items-center justify-center rounded-full overflow-hidden border shadow-sm">
                    <img class="max-h-[132px]" :src="item.image" :alt="item.name"></div>
                <div class="font-semibold text-xs">{{ item.name }}</div>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
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
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            // alert(this.url);
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
    },
}
</script>
