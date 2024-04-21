@extends('masterblade.adminschool')

@section('content')
<style>
    input[type=file], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 55%;
        background-color: #04AA6D;
        color: white;
        padding: 14px 20px;
        margin: 15px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    .container5 {
        border-radius: 115px;
        background-color: #f2f2f2;
        padding: 55px;
    }
</style>
<body>
    <div class="container container5">
        <form action="{{route('addproduct')}}" method="post" enctype="multipart/form-data">
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            @csrf
            <h1>Add Product</h1>
            <p>Product information</p>
            <label for="productid">Product ID</label>
            <span class="text-danger">@error('productid'){{$message}}@enderror</span>
            <input type="text" id="productid" name="productid" placeholder="Enter Product ID" value="{{old('productid')}}">

            <label for="productname">Product Name</label>
            <span class="text-danger">@error('productname'){{$message}}@enderror</span>
            <input type="text" id="productname" name="productname" placeholder="Enter Product Name" value="{{old('productname')}}">

            <label for="productimage">Product Image</label>
            <span class="text-danger">@error('productimage'){{$message}}@enderror</span>
            <input type="file" id="productimage" name="productimage">
            
            <label for="productprice">Product Price</label>
            <span class="text-danger">@error('productprice'){{$message}}@enderror</span>
            <input type="text" id="productprice" name="productprice" placeholder="Enter Product Price (RM)" value="{{old('productprice')}}">

            <label for="productdesc">Product Description</label>
            <span class="text-danger">@error('productdesc'){{$message}}@enderror</span>
            <input type="text" id="productdesc" name="productdesc" placeholder="Enter Product Description" value="{{old('productdesc')}}">
            
            <label for="productcategory">Product Category</label>
            <span class="text-danger">@error('productcategory'){{$message}}@enderror</span>
            <input type="text" id="productcategory" name="productcategory" placeholder="Enter Product Category" value="{{old('productcategory')}}">

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
@endsection