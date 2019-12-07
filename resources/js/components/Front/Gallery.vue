
<template>
<div :id="hGallery.slug">
    <section id="gallery">
        <div class="container">
            <div class="section-header">
                <h2>{{hGallery.judul}}</h2>
                <div v-html="hGallery.isi"></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <gallery :images="images" :index="index" @close="index = null"></gallery>
                    <div class="image" v-for="(image, imageIndex) in images" :key="imageIndex" @click="index = imageIndex" :style="{ background: 'url('+ image +')', width: '300px', height: '200px'}">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</template>

<script>
import VueGallery from 'vue-gallery';
export default {
    components: {
        'gallery': VueGallery
    },
    data() {
        return {
            hGallery: [],
            images: [],
            index: null,
        }
    },
    methods: {
        loadGallery() {
            axios.get('/api/front/galeri').then(({
                data
            }) => (this.images = data));
        },
        loadData() {
            axios.get('/api/front/halaman/gallery').then(({
                data
            }) => (this.hGallery = data));
        }
    },
    created() {
        this.$Progress.start();
        this.loadGallery();
        this.loadData();
        this.$Progress.finish();
        // console.log('Component mounted.')
    }
}
</script>
