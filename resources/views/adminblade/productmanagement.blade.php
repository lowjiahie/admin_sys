@extends('masterblade.adminschool')

@section('content')

<style>
    .table-wrapper {
        width: 1100px;
        margin: 30px auto;
        background: #fff;
        padding: 20px;	
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 6px 0 0;
        font-size: 22px;
    }
    .table-title .add-new {
        float: right;
        height: 30px;
        font-weight: bold;
        font-size: 12px;
        text-shadow: none;
        min-width: 100px;
        border-radius: 50px;
        line-height: 13px;
    }
    .table-title .add-new i {
        margin-right: 4px;
    }
    table.table {
        table-layout: fixed;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table th:last-child {
        width:100px;
    }
    table.table td a {
        cursor: pointer;
        display: inline-block;
        margin: 0 5px;
        min-width: 24px;
    }    
    table.table td a.add {
        color: #27C46B;
    }
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }
    table.table td a.add i {
        font-size: 24px;
        margin-right: -1px;
        position: relative;
        top: 3px;
    }    
    table.table .form-control {
        height: 32px;
        line-height: 32px;
        box-shadow: none;
        border-radius: 2px;
    }
    table.table .form-control.error {
        border-color: #f50000;
    }
    table.table td .add {
        display: none;
    }
</style>
<body>
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                @csrf
                <div class="table-title">
                    <div class="row">
                        <form action="" method="">
                            <div class="col-sm-8"><h1><b>Product Management</b></h1></div>
                            <div class="col-sm-4">
                                <a type="button" class="btn btn-info add-new" href="addproductpage"><i class="fa fa-plus"></i>Add New Product</a>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Product Price(RM)</th>
                            <th>Product Description</th>
                            <th>Product Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $products)
                        <tr>
                            <td>{{$products->prodID}}</td>
                            <td>{{$products->prodName}}</td>
                            <td><img src="{{asset('img/'.$products->prodImage) }}"
                                     style="height:50px; width:100px;"></td>
                            <td>{{$products->prodPrice}}</td>
                            <td>{{$products->prodDesc}}</td>
                            <td>{{$products->prodCategory}}</td>

                            <td>
                                <a class="edit" href="" title="Edit" data-toggle="tooltip"><i class="material-icons">edit</i></a>
                                <a class="delete" onclick="return confirm('Are you sure?')" href="{{url('deleteproduct/'.$products->prodID)}}" title="Delete" data-toggle="tooltip"><i class="material-icons">delete</i></a>
                            </td>
                        </tr>
                        @endforeach      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
@endsection