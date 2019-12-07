<template>
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Tambah Produk</a></li>
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
                            <h3 class="card-title">Tambah Produk</h3>
                            <div class="card-tools">
                                <!-- <router-link to="/admin/halaman/tambah" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>Tambah</router-link> -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <form id="formTambah" action="POST" @submit.prevent="simpanHalaman()" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="">Foto</label>
                                        <input type="file" class="form-control" name="foto[]" multiple>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="">Nama Produk</label>
                                        <input type="text" class="form-control" name="nama_produk" v-model="form.nama_produk" :class="{'is-invalid' : form.errors.has('form.nama_produk')}">
                                        <has-error :form="form" field="nama_produk"></has-error>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="">Deskripsi Produk</label>
                                        <editor api-key="44nsbdus84r0ju13jm2ng5cpchi6ga081o9mku2kxxze6bgk" :init="{plugins: 'wordcount'}" v-model="form.deskripsi" :class="{'is-invalid' : form.errors.has('form.deskripsi')}"></editor>
                                        <textarea name="deskripsi"  rows="8" cols="80" style="display:none;" :value="form.deskripsi"></textarea>
                                        <has-error :form="form" field="deskripsi"></has-error>
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
                nama_produk: '',
                deskripsi: '',
                foto: '',
            })
        }
    },
    methods: {
        simpanHalaman(){
            var formData = new FormData(document.getElementById("formTambah"));
            let instance = this;
            this.$Progress.start();
            axios.post('/api/admin/produk', formData).then((response) => {
                if (response.status) {
                    swal(
                        'Sukses!',
                        response.data.message,
                        'success'
                    )
                    this.form.reset();
                    this.$Progress.finish();
                    this.$router.push({
                        name: 'daftar-produk'
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
        this.$Progress.finish();
    }
}
</script>
