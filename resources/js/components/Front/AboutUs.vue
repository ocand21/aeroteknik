<template>
<div :id="aboutUs.slug">
    <section id="about" class="wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 about-img">
                    <img :src="aboutUs.foto" alt="">
                </div>

                <div class="col-lg-6">
                    <div class="content">
                        <h2>About Us</h2>
                        <div v-html="aboutUs.isi"></div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- #about -->
</div>
</template>

<script>
export default {
    data(){
        return {
            aboutUs: [],
        }
    },
    methods: {
        loadData(){
            axios.get('/api/front/halaman/about-us').then(({
                data
            }) => (this.aboutUs = data));
        }
    },
    created() {
        this.$Progress.start();
        this.loadData();
        this.$Progress.finish();
        // console.log('Component mounted.')
    }
}
</script>
