@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="product">Product name</label>
                <input type="text" name='name' value="{{ $product->name }}" class="form-control" id="product" placeholder="Enter product name">
            </div>
            <div class="form-group">
                <label for="product">Product</label>
                <select name='menu_id' class="form-control">
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}" {{$product->menu_id == $menu->id ? 'selected' : ''}}>{{ $menu->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="product">Price</label>
                <input type="number" name='price' value="{{ $product->price }}" class="form-control" id="price">
            </div>
            <div class="form-group">
                <label for="product">Price Sale</label>
                <input type="number" name='price_sale' value="{{ $product->price_sale }}" class="form-control" id="price_sale">
            </div>
            <div class="form-group">
                <label for="menu">Description</label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="product">Description Detail</label>
                <textarea name="content" id="content" class="form-control">{{ $product->content }} </textarea>
            </div>
            <div class="form-group">
                <label for="product">Product image</label>
                <input type="file" name="file" id="upload" class="form-control">
                <div id="image_show">
                    <a href="{{ $product->thumb }} " target="_blank">
                        <img src="{{ $product->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ $product->thumb }}" id="thumb">
            </div>
            <label>Status</label>
            <div class="form-group">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="active" name="active"
                    {{ $product->active == 1 ? 'checked' : '' }} value="1">
                    <label for="active" class="custom-control-label">Active</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="inactive" name="active"
                    {{ $product->active == 0 ? 'checked' : '' }}  value="0">
                    <label for="no_active" class="custom-control-label">Inactive</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        @csrf
    </form>
@endsection
@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
