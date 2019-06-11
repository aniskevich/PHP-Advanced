<p>User_ID: <?=$user_id?></p>
    <?php foreach ($products as $product) : ?>
    <div class="row">
       <!-- <div class="col-2"><img src="../img/<?=$product->link?>" alt=""></div> -->
        <div class="col-1"><?=$product->name?></div>
        <div class="col-1"><?=$product->category?></div>
        <div class="col-1"><?=$product->type?></div>
        <div class="col-1"><?=$product->color?></div>
        <div class="col-1"><?=$product->size?></div>
        <div class="col-3"><?=$product->about?></div>
        <div class="col-1"><?=$product->price?></div>
        <div class="col-1"><?=$product->quantity?></div>
    </div>
    <?php endforeach;?>
