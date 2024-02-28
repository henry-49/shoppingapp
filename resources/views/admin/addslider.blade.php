@extends('admin_layout.admin')


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Slider</li>
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
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add slider</h3>
              </div>

               @if(Session::has('status'))
                    <div class="alert alert-success">
                        {{Session::get('status')}}
                        {{Session::put('status', null)}}
                    </div>
                 @endif


              @if (count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                </div>
              @endif

              <!-- /.card-header -->
              <!-- form start -->
              {{-- <form > --}}
                {!! Form::open(['route' => 'saveslider', "method" => "post", "class" => "form", "id" => "createUserForm", 'enctype' => 'multipart/form-data']) !!}

                    {{csrf_field()}}

                <div class="card-body">
                  <div class="form-group">
                        {!! Form::label("description_1", "Slider description 1") !!}
                        {!! Form::text("description_1", old('description_1'), ['class' => 'form-control','placeholder' => 'Enter slider description one']) !!}
                </div>
                  <div class="form-group">
                    {!! Form::label("description_2", "Slider description 2") !!}
                        {!! Form::text("description_2", old('description_2'), ['class' => 'form-control','placeholder' => 'Enter slider description two']) !!}
                  </div>
                  <label for="exampleInputFile">Slider image <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="custom-file">
                    {{-- {!! Form::file('stock_image[]', ['multiple' => true]) !!} --}}
                      {!! Form::file('slider_image', ['class'=>'form-control']) !!}
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
              {{-- </form> --}}
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('scripts')

<script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@endsection
