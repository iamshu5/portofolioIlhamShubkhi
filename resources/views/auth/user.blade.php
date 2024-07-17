@include('_partials.header', ['title' => 'User'])

<div class="container">
    <div class="row">
        <div class="col">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb mt-2">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data User</h6>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-info shadow-sm btn-sm" data-bs-toggle="modal"
                            data-bs-target="#ModalTambah" title="Tambah">
                            <i class='bx bx-user-plus'></i> TAMBAH USER
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    {{-- Alert --}}
                    @if (session()->exists('alert'))
                        <div class="alert alert-{{ session()->get('alert') ['bg'] }} alert-dismissible fade show" role="alert">
                            {{ session()->get('alert') ['message'] }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error )
                                {{ $error }}
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-striped table-hover" id="dataTables" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="ModalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel"><i class='bx bx-user-plus'></i> Tambah User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('/user/store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group form-floating mb-3">
                  <input type="text" class="form-control @error('username') is-invalid @enderror fw-bold" name="username" id="username" placeholder="Masukan username" value="{{ old('username') }}" required>
                  <label for="username">Username*</label>
                  @error('username')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group form-floating mb-3">
                  <input type="text" class="form-control @error('passwordHash') is-invalid @enderror fw-bold" name="passwordHash" id="passwordHash" placeholder="Masukan passwordHash" value="{{ old('passwordHash') }}" required></input>
                  <label for="passwordHash">password*</label>
                  @error('passwordHash')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
                </div>

                {{-- Preview Image --}}
                {{-- <div class="col-md-12 mb-2">
                    <img id="preview-image" alt="" class="rounded shadow" style="max-height: 100px;">
                </div> --}}
                {{-- End Preview Image --}}
                <div class="form-group form-floating mb-3">
                  <input type="text" class="form-control @error('nama') is-invalid @enderror fw-bold" name="nama" id="nama" placeholder="Masukan Nama Lengkap" value="{{ old('nama') }}" required>
                  <label for="">Nama*</label>
                  @error('nama')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger"><i class='bx bx-reset'></i> Reset</button>
                <button type="submit" class="btn btn-success"><i class='bx bx-save' style='color:#ffffff' ></i> Save</button>
            </div>
        </form>
      </div>
    </div>
</div>

{{-- Modal Edit --}}
@foreach ($users as $index => $data)
<div class="modal fade" id="ModalEdit{{ $data->id_user }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h1 class="modal-title fs-5 text-white fw-bold" id="staticBackdropLabel"><i class='bx bx-message-square-edit' style='color:#ffffff' ></i> Edit User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ url('/user/update/' . $data->id_user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control @error('username') is-invalid @enderror fw-bold" name="username" id="username" placeholder="Masukan username" value="{{ $data->username }}" required>
                    <label for="username">Username</label>
                    @error('username')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control @error('passwordHash') is-invalid @enderror fw-bold" name="passwordHash" id="passwordHash" placeholder="Isi jika ingin diubah">
                    <label for="passwordHash">Password</label>
                    @error('passwordHash')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror fw-bold" name="nama" id="nama" placeholder="Masukan Nama Lengkap" value="{{ $data->nama }}" required>
                    <label for="">Nama*</label>
                    @error('nama')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning"><i class='bx bx-save' style='color:#ffffff' ></i> Change</button>
            </div>
        </form>
      </div>
    </div>
</div>
@endforeach

{{-- Modal Delete --}}
@foreach ($users as $index => $data)
<div class="modal fade" id="ModalDelete{{ $data->id_user }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title text-white fw-bold" id="exampleModalLabel">DELETE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="font-weight-bold text-uppercase">HAPUS USER {{ $data->username }} ?</h5>
            </div>
            <div class="modal-footer">
                <a href="{{ url('/user/destroy/' . $data->id_user) }}" class="btn btn-danger"><i class='bx bx-trash' style='color:#ffffff' ></i> DELETE</a>
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@include('_partials.footer')

<script>
    $(function() {
        const table = $('#dataTables').DataTable( {
            processing: true,
            serverSide: true,
            searching: true,
            ordering: true,
            responsive: true,
            ajax: { 
                url: location.href,
                data: function (d) {
                    d._token = "{{ csrf_token() }}";
                },
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: false },
                {data: 'username', name: 'username' },
                {data: 'nama', name: 'nama' },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            lengthMenu: [ 
                [5, 25, 50, "All"], 
                [5, 25, 50, "All"] 
            ],
            dom:
                "<'row'<'col-md-2'l><'col-md-5'B><'col-md-5'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            buttons: [
                'excel', 'colvis'
            ]
        });

        // // Event handler untuk mengatur modal gambar besar
        // $('#dataTables tbody').on('click', 'img', function () {
        //     const src = $(this).attr('src');
        //     $('#gambarBesar').attr('src', src);
        //     $('#modalGambar').modal('show');
        // });

        setInterval(function() {
            table.ajax.reload(null, false); // Reloads data without resetting the pagination
        }, 500000); // 30000 milliseconds = 30 seconds
        // END DATATABLE

        // $(document).ready(function (e) {
        //     $('#image').change(function(){     
        //         let reader = new FileReader();
        //         reader.onload = (e) => { 
        //             $('#preview-image').attr('src', e.target.result); 
        //         }
        //         reader.readAsDataURL(this.files[0]); 
        //     });  
        // });
        // $(document).ready(function (e) {
        //     $('#image-edit').change(function(){     
        //         let reader = new FileReader();
        //         reader.onload = (e) => { 
        //             $('#preview-image-edit').attr('src', e.target.result); 
        //         }
        //         reader.readAsDataURL(this.files[0]); 
        //     });  
        // });
    })
</script>