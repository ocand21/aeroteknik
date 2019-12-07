<template>
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Halaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ubah Halaman</a></li>
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
                            <h3 class="card-title">Ubah Halaman</h3>
                            <div class="card-tools">
                                <!-- <router-link to="/admin/halaman/tambah" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>Tambah</router-link> -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <form action="POST" @submit.prevent="simpanHalaman()">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="">Foto</label>
                                    <input type="file" class="form-control" @change="uploadFoto" name="foto">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="">Judul Halaman</label>
                                    <input type="text" class="form-control" name="judul" v-model="form.judul" :class="{'is-invalid' : form.errors.has('form.judul')}">
                                    <has-error :form="form" field="judul"></has-error>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="">Isi Halaman</label>
                                    <editor api-key="44nsbdus84r0ju13jm2ng5cpchi6ga081o9mku2kxxze6bgk" :init="{plugins: 'wordcount'}" v-model="form.isi" :class="{'is-invalid' : form.errors.has('form.isi')}"></editor>
                                    <has-error :form="form" field="isi"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
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
import Editor from '@tinymce/tinymce-vue';
export default {
    components: {
        // DatePicker,
        'editor': Editor,
    },
    data() {
        return {
            form: new Form({
                judul: '',
                isi: '',
                foto: '',
            })
        }
    },
    methods: {
        loadData(){
            axios.get('/api/admin/halaman/' + this.$route.params.id).then(({
                data
            }) => (this.form.fill(data)));
        },
        simpanHalaman(){
            this.$Progress.start();
            this.form.put('/api/admin/halaman/' + this.$route.params.id).then((response) => {
                if (response.status) {
                    swal(
                        'Sukses!',
                        response.data.message,
                        'success'
                    )
                    this.form.reset();
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                    this.$router.push({
                        name: 'daftar-halaman'
                    });
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
        uploadFoto(e){
            let file = e.target.files[0];
            console.log(file);
            let reader = new FileReader();
            reader.onloadend = (file) => {
                this.form.foto = reader.result;
            }
            reader.readAsDataURL(file);
        }

    },
    created() {
        this.$Progress.start();
        this.loadData();
        this.$Progress.finish();
    }
}
</script>
