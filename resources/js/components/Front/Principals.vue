<template>
<div :id="principals.slug">
    <section id="services">
      <div class="container">
        <div class="section-header">
          <h2>{{principals.judul}}</h2>
        </div>
        <div class="content" v-html="principals.isi"></div>

      </div>
    </section>
</div>
</template>

<script>
export default {
    data(){
        return {
            principals: [],
        }
    },
    methods: {
        loadData(){
            axios.get('/api/front/halaman/principals').then(({
                data
            }) => (this.principals = data));
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
