<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if (!$user->is_approved)
                        <form action="{{ route('admin.approve', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit">Approve</button>
                        </form>
                    @else
                        Approved
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>
                    @if (!$product->is_approved)
                        <form action="{{ route('adminproduct', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit">Approve</button>
                        </form>
                    @else
                        Approved
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
