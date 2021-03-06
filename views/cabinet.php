
<div class="row border border-dark">
    <div class="col-1">id</div>
    <div class="col-2">user mail</div>
    <div class="col-1">payment</div>
    <div class="col-2">delivery address</div>
    <div class="col-3">date</div>
    <div class="col-2">sum</div>
    <div class="col-1">status</div>
</div>
<?php foreach ($orders as $order) :?>
<div class="row cart border border-dark p-3">
    <div class="col-1"><?=$order[id]?></div>
    <div class="col-2">{{ order.user_mail }}</div>
    <div class="col-1">{{ order.payment }}</div>
    <div class="col-2">{{ order.address }}</div>
    <div class="col-3">{{ order.date }}</div>
    <div class="col-2">Total: {{ order.sum }}</div>
    <div class="col-1">{{ order.status }}</div>
    <?php foreach ($product as $order[cart]) :?>
    <div class="col-12">
        <div class="row border border-dark">
            <div class="col-2">name</div>
            <div class="col-2">size</div>
            <div class="col-2">color</div>
            <div class="col-2">price</div>
            <div class="col-2">quantity</div>
            <div class="col-2">subtotal</div>
        </div>
        <div class="row p-3">
            <div class="col-2">{{ product.name }}</div>
            <div class="col-2">{{ product.size }}</div>
            <div class="col-2">{{ product.color }}</div>
            <div class="col-2">{{ product.price }}</div>
            <div class="col-2">{{ product.quantity }}</div>
            <div class="col-2">{{ product.subtotal }}</div>
        </div>
    </div>
    <?php endforeach ?>
</div>
<?php endforeach ?>