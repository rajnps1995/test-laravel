<!DOCTYPE html>
<html>

<head>
    <title>Laravel 7 Form Validation</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/datatables.css') }}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/bootstrap.css') }}">

    <!-- Jquery Datatable-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/jquery.dataTables.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- latest jquery-->
    <script src="{{ asset('admin_assets/js/jquery-3.2.1.min.js') }}"></script>

    <script type="text/javascript" charset="utf8" src="{{ asset('admin_assets/js/jquerydatatable/jquery.dataTables.js') }}">
    </script>
    <style>
        .fa-trash {
            margin-left: 25px;
        }

        .corect {
            color: orange;
        }

    </style>

</head>

<body class="bg-pink">
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Manage Category & Sub Category</h4>

                             <div class="page-title-right">
                                <a href="{{ route('home') }}" <button type="button" id="submit_product" name="submit_product" class="btn btn-primary w-md">Home</button></a>

                                <a href="{{ route('category.index') }}" <button type="button" id="submit_product" name="submit_product" class="btn btn-primary w-md">Add Category</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">

                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card">

                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="app_table" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="2%">Name</th>
                                            <th width="2%">Image</th>
                                            <th width="2%">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categoryData as $categoryDatadetails)
                                            <tr>
                                                <td>{{ $categoryDatadetails->name }}</td>

                                                <td><img src='/{{ $categoryDatadetails->user_img }}'
                                                        style='width: 40%;'></td>

                                                <td><a href="{{route('category.edit', encrypt($categoryDatadetails->id))}}" class="edit_services">
                                                    <i class="fa fa-edit"></i></a>
                                                <a href="{{route('categories.destroy', encrypt($categoryDatadetails->id))}}" class="delete_services">
                                                    <i class="fa fa-trash"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->


            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // alert('hi');
            $('.app_table').DataTable({
                'order': []
            });

        });
        var redirectPost = function(url, data = null, method = 'post') {
            var form = document.createElement('form');
            form.method = method;
            form.action = url;
            for (var name in data) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = data[name];
                form.appendChild(input);
            }
            $('body').append(form);
            form.submit();
        }
    </script>
    <!-- Plugins JS start-->
    <script src="{{ asset('admin_assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/datatable/datatables/datatable.custom.js') }}"></script>
</body>

</html>
