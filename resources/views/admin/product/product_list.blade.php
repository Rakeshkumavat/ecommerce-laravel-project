@extends('admin.layout.main')
@section('main-container')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.product_form')}}">Add Product</a></li>
              <li class="breadcrumb-item active">Product List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Product List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! $dataTable->table(['class' =>  'table table-bordered table-hover dt-responsive']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('page_scripts')
{!! $dataTable->scripts() !!}
    <script type="text/javascript">
  $(function () {

    $("body").on("click", ".status", function(e) {
            e.preventDefault();
            if (confirm('Are you sure change status?')) {
                t = $(this);
                var id = $(this).attr('id');
                var url = $(this).attr('url');
                console.log(url)
                $.ajax({
                    url:url,
                    type: 'get',
                    data:{
                        'id':id,
                    },
                    error: function() {},
                    beforeSend: function() {
                        console.log(1)
                        // t.prop('disabled', true);
                    },
                    complete: function() {
                        console.log(2)
                        // t.prop('disabled', false);
                    },
                    success: function(response) {
                        if (response.status) {
                            window.LaravelDataTables['product-table'].draw();
                        }
                        console.log(response);
                        // window.location.href = "{{ route('admin.category-list') }}";

                    }
                });
            }
        });

    $("body").on("click", ".delete_data", function(e) {
            e.preventDefault();
            if (confirm('Are you sure want to delete?')) {
                t = $(this);
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'get',
                    error: function() {},
                    beforeSend: function() {
                        t.prop('disabled', true);
                    },
                    complete: function() {
                        t.prop('disabled', false);
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.status) {
                             window.LaravelDataTables['product-table'].draw();
                        }
                    }
                });
            }

        });

  });
</script>
@endpush