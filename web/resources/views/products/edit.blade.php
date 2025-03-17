<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Chỉnh sửa sản phẩm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .container {
            max-width: 600px;
            margin-top: 30px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-custom {
            width: 100%;
            margin-top: 10px;
        }

        .alert-danger {
            padding: 5px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Chỉnh sửa sản phẩm</h2>

        <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" name="title" value="{{ $product->title }}" class="form-control" required>
                @error('title')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Giá</label>
                <input type="text" name="price" value="{{ $product->price }}" class="form-control" required>
                @error('price')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Ảnh sản phẩm</label>
                <input type="file" name="image" class="form-control">
                @error('image')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
                <br>
                <img src="{{ asset('images/' . $product->image) }}" width="150">
            </div>

            <div class="form-group">
                <label>Số lượng</label>
                <input type="text" name="stock" value="{{ $product->stock }}" class="form-control" required>
                @error('stock')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                @error('description')
                <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Ngừng hoạt động</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success btn-custom">Cập nhật</button>
            <a href="{{ route('products.index') }}" class="btn btn-danger btn-custom">Hủy</a>
        </form>
    </div>
</body>

</html>
