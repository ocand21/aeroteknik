<template>
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
                    Selamat Datang
                  </div>
                  <div class="card-body">

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
    data(){
      return{
        dataSummary: [],
        dataLogs: [],
        columns: [
            'nama', 'pangkat', 'nama_wilayah','hak', 'action', 'method', 'created_at'
        ],
        options: {
            texts: {
                filterPlaceholder: "Cari data",
                filter: "Pencarian : ",
                filterBy: "Cari {column}",
                count: "Menampilkan {from} ke {to} dari {count} data|{count} data|1 data",
            },
            headings: {
                method: 'Aksi',
                nama_wilayah: 'Nama Wilayah',
                action: 'Log',
                created_at: 'Waktu & Tgl',
            },
            sortable: ['nama', 'pangkat', 'nama_wilayah', 'method', 'hak', 'action', 'created_at' ],
            filterable: ['nama', 'pangkat', 'nama_wilayah', 'method', 'hak', 'action', 'created_at' ],
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

    },
    created() {

    }
}
</script>
