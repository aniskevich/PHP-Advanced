<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
    <?php if ($username)  :?>
    <ul class="nav justify-content-center mt-2">
        <li class="nav-item">
            <a class="nav-link active" href="?c=user&a">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?c=product&a=catalog&p=1">Catalog</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?c=cart&a">Cart</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?c=user&a=cabinet">Cabinet</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?c=user&a=logout">Logout</a>
        </li>
    </ul>
    <?php endif ?>
<?=$content?>
</div>
</body>
</html>

