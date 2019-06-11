<div class="row">
<?php foreach ($products as $product) :?>
<div class="col-4 mb-2">
    <div class="card border-dark text-center" style="width: 18rem;">
        <img src="../img/<?=$product['link']?>" class="card-img-top" alt="">
        <div class="card-body text-dark">
            <h5 class="card-title"><?=$product['name']?></h5>
            <p class="card-text"><?=$product['about']?></p>
            <p class="card-text"><?=$product['price']?> $</p>
            <a href="?c=product&a=card&id=<?=$product['id']?>" class="btn btn-dark">Detail</a>
        </div>
    </div>
</div>
<?php endforeach; ?>
</div>
<a class="btn btn-dark" href="?c=product&a=catalog&p=<?=$_GET['p'] +1 ?>">Show more</a>