<template>
<div :id="hProducts.slug">
    <section id="services">
      <div class="container">
        <div class="section-header">
          <h2>{{hProducts.judul}}</h2>
          <div v-html="hProducts.isi"></div>
        </div>

        <div class="row">

          <div class="col-lg-12" v-for="product in products" :key="product.id">
            <div class="box wow fadeInLeft table-responsive">
              <div class="row">
                  <div class="col-md-4">
                      <div class="icon">
                          <img :src="product.foto" alt="" width="400x">
                      </div>
                  </div>
                  <div class="col-md-7">
                      <h4 class="title"><a href="">{{product.nama_produk}}</a></h4>
                      <div class="description" v-html="product.deskripsi"></div>
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
export default {
    data(){
        return {
            hProducts: [],
            products: [],
        }
    },
    methods: {
        loadProducts(){
            axios.get('/api/front/produk').then(({
                data
            }) => (this.products = data));
        },
        loadData(){
            axios.get('/api/front/halaman/products').then(({
                data
            }) => (this.hProducts = data));
        }
    },
    created() {
        this.$Progress.start();
        this.loadProducts();
        this.loadData();
        this.$Progress.finish();
        // console.log('Component mounted.')
    }
}
</script>
