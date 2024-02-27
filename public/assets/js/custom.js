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
                            window.LaravelDataTables['users-table'].draw();
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
                             window.LaravelDataTables['users-table'].draw();
                        }
                    }
                });
            }

        });



// edit
            $("#submitBtn").click(function (e) {
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
// add
     $("#submit").click(function (xhr) {
            // console.log($('#myform').serialize())
            my_form = $('#myform');
            $('.js_error_span').html("");
            
            xhr.preventDefault();
                // var url = $(this).attr('href');
                  var form_data = new FormData(my_form[0]);
                  console.log(form_data)
                $.ajax({
                    url: "{{ route('admin.category') }}",
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