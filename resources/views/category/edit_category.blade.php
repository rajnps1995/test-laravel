<!DOCTYPE html>
<html>
<head>
    <title>Edit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y=" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-3 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Category Details-</h5>
                    </div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                        <form class="form-horizontal" action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PATCH">
                            @csrf
                            <div class="form-group">
                                <label><strong>Name : </strong></label>
                                <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control" required="">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            </div>
                            <div class="form-group">
                                <label><strong>Image : </strong></label>
                                <div class="d-flex justify-content-center">
                                    <div class="btn btn-mdb-color btn-rounded">
                                    <img src="\{{$category->user_img}}" alt="people" class="offrlck" width="56" id="img-upload">
                                      <input class="form-control offrimg" type="file" id="user_img" value="{{old('image')}}" name="user_img">
                                      @if ($errors->has('user_img'))
                                      <span class="text-danger">{{ $errors->first('user_img') }}</span>
                                  @endif
                                    </div>
                                  </div>
                            </div>
                            <div class="form-group">
                                <button type="button" id="btn" class="btn btn-info">Add Sub Category</button>
                            </div>
                            <div id="Create" style="display:none">
                                <div class="form-group">
                                    <label><strong>Sub Category : </strong></label>
                                    <input type="text" name="sub_category_name" value="{{$sub_category->sub_category_name}}" id="sub_category_name" class="form-control" required="">
                                    @if ($errors->has('sub_category_name'))
                                    <span class="text-danger">{{ $errors->first('sub_category_name') }}</span>
                                @endif
                                </div>
                                </div>
                            <div class="form-group text-center">
                                <input type="submit" class="btn btn-success" name="submit" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#img-upload').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#user_img").change(function() {
    readURL(this);
  });

  $(document).ready(function () {
    $("#btn").click(function () {
        $("#Create").toggle();
    });
});
    </script>
</body>
</html>
