<div class="row">
    <div class="col-12 mb-2">
        <div class="card border-dark text-center" style="width: 18rem;">
            <img src="../img/<?=$product->link?>" class="card-img-top" alt="">
            <div class="card-body text-dark">
                <h5 class="card-title"><?=$product->name?></h5>
                <p class="card-text"><?=$product->about?></p>
                <p class="card-text"><?=$product->price?> $</p>
                <p class="card-text"><?=$product->color?></p>
                <p class="card-text"><?=$product->size?></p>
                <a href="#" class="btn btn-dark">Buy</a>
            </div>
        </div>
    </div>
    <a href="?c=product&a=catalog&p=1" class="btn btn-dark">Back</a>
</div>