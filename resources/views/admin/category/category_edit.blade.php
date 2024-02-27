@extends('admin.layout.main')
@section('main-container')
@push('page_css')
@endpush

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
        <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Category Edit </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="myform" action="{{route('admin.category-update')}}" method="POST">
                @csrf
                <div class="card-body">
                  <input type="hidden" name="id" class="form-control" placeholder=""
                                value="{{ $category->id }}">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{old('name',$category->name)}}">
                    <span class="js_error_span"></span>
                    <div class="form-group">
                    <label for="exampleInputFile">Upload Image</label>
                        <input type="file" class="form-control" name="image" id="image" value="{{$category->image}}">
                        <span class="js_error_span"></span>
                  </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection
@push('page_scripts')
<script type="text/javascript">
  $(function(){
           $("#submit").click(function (e) {
            // console.log($('#myform').serialize())
            my_form = $('#myform');
            $('.js_error_span').html("");
            
            e.preventDefault();
                // var url = $(this).attr('href');
                  var form_data = new FormData(my_form[0]);
                  console.log(form_data)
                $.ajax({
                    url: "{{ route('admin.category-update') }}",
                    type: 'post',
                    dataType: 'json',
                    data:form_data,
                    contentType: false,
                    cache: false,
                    processData:false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    error: function(e) {
                      validation_errors = e.responseJSON.errors;

                      $.each(validation_errors, function( k, v ){
                        // my_form.find('#'+k).addClass('invalid');
                        my_form.find('#'+k).parent('div .form-group').find('.js_error_span').html(v[0]);
                    });
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.status) {
                             window.location="{{route('admin.category-list')}}"
                        }
                    }
                });
            });  
  });


</script>
@endpush
