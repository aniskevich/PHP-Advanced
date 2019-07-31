<div class="topBanner">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>NEW ARRIVALS</p>
            </div>
            <div class="col-md-6">
                <nav aria-label="breadcrumb" class="topNav">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">HOME</a></li>
                        <li class="breadcrumb-item"><a href="#">MEN</a></li>
                        <li class="breadcrumb-item"><a href="#">NEW ARRIVALS</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- <single-product :product="product" @handlebuy="handleBuy"></single-product> -->
<div>
    <div class="singlePageBanner">
        <div id="carouselSinglePage" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselSinglePage" data-slide-to="0" class="active"></li>
                <li data-target="#carouselSinglePage" data-slide-to="1"></li>
                <li data-target="#carouselSinglePage" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/images/<?= $product->link ?>">
                </div>
                <div class="carousel-item">
                    <img src="/images/<?= $product->link ?>">
                </div>
                <div class="carousel-item">
                    <img src="/images/<?= $product->link ?>">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselSinglePage" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselSinglePage" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="description">
            <div class="descInside">
                <h4><?=$product->category?> COLLECTION</h4>
                <h3><?=$product->name?></h3>
                <p><?=$product->about?></p>
                <div class="material">
                    <h4>MATERIAL: <span>{{ product.material }}</span></h4>
                    <h4>DESIGNER: <span>{{ product.designer }}</span></h4>
                </div>
                <h3 class="cost">$ <?=$product->price?>.00</h3>
                <div class="options">
                    <form @submit.prevent="handleBuy">
                        <div>
                                <label for="selectColor">Choose color</label>
                                <select name="selectColor" id="selectColor">
                                    <option v-for="(option, index) in product.color" :value="option" class="{ 'active': index === 0 }">{{ option }}</option>
                                </select>
                            </div>
                            <div>
                                <label for="selectSize">Choose size</label>
                                <select name="selectSize" id="selectSize">
                                    <option v-for="(option, index) in product.size" :value="option" class="{ 'active': index === 0 }">{{ option }}</option>
                                </select>
                        </div>
                        <div>
                            <label for="selectQuantity">Quantity</label>
                            <input type="number" name="selectQuantity" required>
                        </div>
                        <input type="submit" value="Add to Cart" id="buyBtn">
                    </form>
                </div>
            </div>
        </div>
        <div class="alsoLike">
            <h2>you may like also</h2>
            <items-list :query="search"></items-list>
        </div>
    </div>
</div>