<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm Sản Phẩm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .alert-danger {
            padding: 5px;
            border-radius: 5px;
            margin-top: 5px;
            font-size: 14px;
        }

        .btn-create {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn-create:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center">Thêm Sản Phẩm Mới</h2>

        <!-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif -->

        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Tên sản phẩm</label>
                <input type="text" name="title" class="form-control" placeholder="Nhập tên sản phẩm" />
                @error('title')
                <p class="alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Giá sản phẩm</label>
                <input type="text" name="price" class="form-control" placeholder="Nhập giá sản phẩm" />
                @error('price')
                <p class="alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Hình ảnh</label>
                <input type="file" name="image" class="form-control" accept="image/*" />
                @error('image')
                <p class="alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Số lượng</label>
                <input type="text" name="stock" class="form-control" placeholder="Nhập số lượng" />
                @error('stock')
                <p class="alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Mô tả sản phẩm</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Nhập mô tả sản phẩm"></textarea>
                @error('description')
                <p class="alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1">Còn hàng</option>
                    <option value="0">Hết hàng</option>
                </select>
            </div>

            <button type="submit" class="btn btn-create">➕ Thêm sản phẩm</button>
        </form>
    </div>
<!-- back -->
    <a class="btn btn-primary" href="{{ route('products.index') }}">Quay lại</a>
</body>

</html>
