<template>
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Halaman</a></li>
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
                            <h3 class="card-title">Halaman</h3>
                            <div class="card-tools">
                                <router-link to="/admin/halaman/tambah" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>Tambah</router-link>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <v-client-table :data="dataHalaman" :columns="columns" :options="options">
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
</div>
</template>

<script>
export default {
    data() {
        return {
            dataHalaman: [],
            columns: [
                'aksi', 'foto', 'judul',
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
                sortable: ['judul'],
                filterable: ['judul'],
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
        editHalaman(id){
            this.$router.push({
                name: 'edit-halaman',
                params: {
                    id: id,
                }
            });
        },
        loadData() {
            axios.get('/api/admin/halaman').then(({
                data
            }) => (this.dataHalaman = data));
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
