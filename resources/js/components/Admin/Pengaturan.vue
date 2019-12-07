<template>
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengaturan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
                </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">

            <!-- /.row -->
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    Pengaturan Website
                  </div>
                  <form action="POST" @submit.prevent="simpanData()">
                  <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="">Favicon</label>
                            <input type="file" @change="uploadFavicon" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <img :src="this.form.favicon" alt="" width="60px">
                        </div>
                        <div class="col-md-3">
                            <label for="">Logo</label>
                            <input type="file" @change="uploadLogo" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <img :src="this.form.logo" width="160px" alt="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="">Header Image</label>
                            <input type="file" class="form-control" @change="uploadHeader">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="">Judul Web</label>
                            <input type="text" class="form-control" name="judul_web" v-model="form.judul_web" :class="{'is-invalid' : form.errors.has('form.judul_web')}">
                            <has-error :form="form" field="judul_web"></has-error>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="">Deskripsi Web</label>
                            <input type="text" class="form-control" name="deskripsi_web" v-model="form.deskripsi_web" :class="{'is-invalid' : form.errors.has('form.deskripsi_web')}">
                            <has-error :form="form" field="deskripsi_web"></has-error>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="email" v-model="form.email" :class="{'is-invalid' : form.errors.has('form.email')}">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="col-md-6">
                            <label for="">Whatsapp</label>
                            <input type="text" class="form-control" name="whatsapp" v-model="form.whatsapp" :class="{'is-invalid' : form.errors.has('form.whatsapp')}">
                            <has-error :form="form" field="whatsapp"></has-error>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="">Facebook</label>
                            <input type="text" class="form-control" name="facebook" v-model="form.facebook" :class="{'is-invalid' : form.errors.has('form.facebook')}">
                            <has-error :form="form" field="facebook"></has-error>
                        </div>
                        <div class="col-md-6">
                            <label for="">Instagram</label>
                            <input type="text" class="form-control" name="instagram" v-model="form.instagram" :class="{'is-invalid' : form.errors.has('form.instagram')}">
                            <has-error :form="form" field="instagram"></has-error>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="">Footer Web</label>
                            <input type="text" class="form-control" name="footer" v-model="form.footer" :class="{'is-invalid' : form.errors.has('form.footer')}">
                            <has-error :form="form" field="footer"></has-error>
                        </div>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
</template>

<script>
export default {
    data(){
      return{
        dataSummary: [],
        dataLogs: [],
        form: new Form({
            favicon: '',
            logo: '',
            header: '',
            judul_web: '',
            deskripsi_web: '',
            email: '',
            whatsapp: '',
            instagram: '',
            facebook: '',
            footer: '',
        }),
      }
    },
    methods: {
        simpanData(){
            this.$Progress.start();
            this.form.post('/api/admin/pengaturan').then((response) => {
                if (response.status) {
                    swal(
                        'Sukses!',
                        'Konfigurasi diubah.',
                        'success'
                    )
                    this.form.reset();
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                } else {
                    swal(
                        'Gagal!',
                        response.data.message,
                        'warning'
                    )
                }
            }).catch(() => {
                swal(
                        'Server Error!',
                        'Terjadi kesalahan',
                        'warning'
                    )
            })
        },
        loadData(){
            axios.get('/api/admin/pengaturan').then(({
                data
            }) => (this.form.fill(data)))
        },
        uploadHeader(e){
            let file = e.target.files[0];
            console.log(file);
            let reader = new FileReader();
            reader.onloadend = (file) => {
                this.form.header = reader.result;
            }
            reader.readAsDataURL(file);
        },
        uploadFavicon(e){
            let file = e.target.files[0];
            console.log(file);
            let reader = new FileReader();
            reader.onloadend = (file) => {
                this.form.favicon = reader.result;
            }
            reader.readAsDataURL(file);
        },
        uploadLogo(e){
            let file = e.target.files[0];
            console.log(file);
            let reader = new FileReader();
            reader.onloadend = (file) => {
                this.form.logo = reader.result;
            }
            reader.readAsDataURL(file);
        },
    },
    created() {
        this.$Progress.start();
        this.loadData();
        Fire.$on('AfterCreate', () => {
            this.loadData();
        });
        this.$Progress.finish();
    }
}
</script>
