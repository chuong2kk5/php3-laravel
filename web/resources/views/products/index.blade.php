<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh Sách Sản Phẩm</title>
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
            margin-top: 20px;
        }

        .btn-create {
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .btn-create:hover {
            background-color: #0056b3;
        }

        .custom-table {
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }

        td,
        th {
            text-align: center;
            vertical-align: middle !important;
        }

        img.product-image {
            width: 150px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 3px;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="text-center">Danh Sách Sản Phẩm</h1>

        @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif

        <a class="btn btn-create" href="{{ route('products.create') }}">➕ Thêm sản phẩm</a>

        <table class="table table-bordered table-hover custom-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                        <td><img class="product-image" src="images/{{ $product->image }}" /></td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Sửa</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination-container">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>

    </div>

</body>

</html>
