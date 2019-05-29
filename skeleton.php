<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <!-- Рендер каталога -->
    <div style="display: flex">
        <?php
            $catalog = getCatalog($connect);
            foreach ($catalog as $idx) {
                extract(getProduct($idx['id'], $connect));
                $productCard = new ProductCard($id, $link, $name, $price);
                $productCard->render();
            }
        ?>
    </div>
    <!-- Заготовка под модалку -->
    <div class="detail">
        <?php
            extract(getProduct(1, $connect));
            $productDetail = new ProductDetail($id, $link, $name, $price, $size, $color, $about);
            $productDetail->render();
        ?>
    </div>
</body>
</html>