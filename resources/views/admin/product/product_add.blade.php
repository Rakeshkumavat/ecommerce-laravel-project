@extends('admin.layout.main')
@section('main-container')
@push('page_css')
@endpush
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>

    <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Product Add</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="myform" action="{{ route('admin.product_store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Product Name">
                    <span class="js_error_span"></span>
                  </div>
                   <div class="form-group">
                    <label for="description">Product Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount"  placeholder="Product Amount">
                    <span class="js_error_span"></span>
                  </div>  
                   <div class="form-group">
                    <label for="quantity">Product Quantity</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Product Quantity">
                    <span class="js_error_span"></span>
                  </div>
                  <div class="form-group">
                      <label>Product Description</label>
                      <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter ..."></textarea>
                      <span class="js_error_span"></span>
                  </div>
                  <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id" id="category_id">
                          <option>select category</option>
                          @foreach ($categorys as $key => $value)
                          <option value="{{ $key }}">{{$value }}</option>
                          @endforeach
                        </select>
                        <span class="js_error_span"></span>
                      </div>
                  <div class="form-group">
                    <label for="image">Product Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="form-control" name="image" id="image" value="">
                        <span class="js_error_span"></span>
                        <!-- <label class="custom-file-label" for="image">Choose file</label> -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary submit">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
@endsection  
@push('page_scripts')
<script type="text/javascript">
$(function () {
      $(".submit").click(function (xhr) {
            // console.log($('#myform').serialize())
            my_form = $('#myform');
            $('.js_error_span').html("");
            
            xhr.preventDefault();
                // var url = $(this).attr('href');
                  var form_data = new FormData(my_form[0]);
                  console.log(form_data)
                $.ajax({
                    url: "{{ route('admin.product_store') }}",
                    type: 'post',
                    dataType: 'json',
                    data:form_data,
                    contentType: false,
                    cache: false,
                    processData:false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    error: function(xhr) {
                      validation_errors = xhr.responseJSON.errors;

                      $.each(validation_errors, function( k, v ){
                        // console.log(k);
                        // console.log(v);
                        // my_form.find('#'+k).addClass('invalid');
                        my_form.find('#'+k).parent('div .form-group').find('.js_error_span').html(v[0]);
                    });
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.status) {
                             window.location="{{route('admin.product_list')}}"
                        }
                    }
                });
            });   
        });


</script>
@endpush