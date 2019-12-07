<template>
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Galeri</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Galeri</a></li>
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
                            <h3 class="card-title">Galeri</h3>
                            <div class="card-tools">
                                <a href="#" @click.prevent="modalGaleri" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>Tambah</a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <v-client-table :data="dataGaleri" :columns="columns" :options="options">
                                <div slot="aksi" slot-scope="{row}">
                                    <a href="" @click.prevent="editHalaman(row.id)" style="margin: 5px" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></a>
                                    <!-- <a href="" @click.prevent="deleteTim(row.id)" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a> -->
                                </div>
                                <div slot="foto" slot-scope="{row}" class="text-center">
                                    <img :src="row.foto" class="img-circle text-center" width="120" height="120" alt="">
                                </div>
                                <!-- <p slot="isi" slot-scope="{row}" v-html="row.isi"></p> -->

                            </v-client-table>
                        </div>
                        <div class="card-footer text-right">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

    <div class="modal fade" id="modal-upload">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Galeri</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="POST" enctype="multipart/form-data" id="formUpload" @submit.prevent="uploadGaleri()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Upload Foto</label>
                            <input type="file" name="foto[]" class="form-control" multiple>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-right">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            dataGaleri: [],
            columns: [
                'aksi', 'foto', 'deskripsi',
            ],
            options: {
                texts: {
                    filterPlaceholder: "Cari data",
                    filter: "Pencarian : ",
                    filterBy: "Cari {column}",
                    count: "Menampilkan {from} ke {to} dari {count} data|{count} data|1 data",
                },
                headings: {

                },
                sortable: ['deskripsi'],
                filterable: ['deskripsi'],
                columnsDisplay: {},
                filterByColumn: true,
                pagination: {
                    dropdown: false
                },
                columnsClasses: {
                    aksi: 'text-center',
                },
            },
        }
    },
    methods: {
        uploadGaleri(){
            var formData = new FormData(document.getElementById("formUpload"));
            let instance = this;
            this.$Progress.start();
            axios.post('/api/admin/galeri', formData).then((response) => {
                if (response.status) {
                    swal(
                        'Sukses!',
                        response.data.message,
                        'success'
                    )
                    this.form.reset();
                    Fire.$emit('AfterCreate');
                    $('#modal-upload').modal('hide');
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
        modalGaleri(){
            $('#modal-upload').modal('show');
        },
        editHalaman(id) {
            this.$router.push({
                name: 'edit-halaman',
                params: {
                    id: id,
                }
            });
        },
        loadData() {
            axios.get('/api/admin/galeri').then(({
                data
            }) => (this.dataGaleri = data));
        }
    },
    created() {
        this.$Progress.start();
        this.loadData();
        Fire.$on('AfterCreate', () => {
            this.loadData('');
        });
        this.$Progress.finish();
    }
}
</script>
