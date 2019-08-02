

Vue.component('search-field', {
    template: `
        <form class="search col-lg-4 col-md-5" @submit.prevent>
            <div class="searchBrowse">
                Browse <i class="fas fa-caret-down"></i>
            </div>
            <input placeholder="Search for Item..." type="text" v-model="search">
            <button @click="handleSearchClick">
                <i class="fas fa-search"></i>
            </button>
        </form>
    `,
    data() {
        return {
            search: '',
        };
    },
    methods: {
        handleSearchClick() {
            this.$emit('searchclick', this.search);
        }
    }
});

Vue.component('items-list', {
    props: ['query'],
    data() {
        return {
            catalogData: [],
        };
    },
    template: `
    <div class="row itemsLayout container">
        <product v-for="product in filteredCatalogData" :product="product"></product>
    </div>
    `,
    computed: {
        filteredCatalogData() {
            const regexp = new RegExp(this.query, 'i');
            return this.catalogData.filter((product) => regexp.test(product.name));
        },
    },
    mounted() {
        fetch(`/api/catalog/`)
            .then((response) =>
                response.json()
            )
            .then((catalogData) => {
                this.catalogData = catalogData;
            });
    }
});

Vue.component('product', {
    props: ['product'],
    template: `
    <div>
        <div class="card product">
            <img :src="/images/ + product.link" class="card-img-top">
            <div class="card-body">
                <h4 class="card-text">{{ product.name }}</h4>
                <h3 class="card-text">$ {{ product.price }}.00</h3>
            </div>
            <div class="buyFade">
                <a :href="'/product/card/?id=' + product.id"><button>Add to Cart</button></a>
            </div>
        </div>
    </div>
    `
});

Vue.component('single-product', {
    data() {
        return {
            product: {},
            computedProduct: {},
        };
    },
    template:`
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
                <img :src="/images/ + product.link">
                </div>
                <div class="carousel-item">
                <img :src="/images/ + product.link">
                </div>
                <div class="carousel-item">
                <img :src="/images/ + product.link">
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
                <h4>{{ product.category }} COLLECTION</h4>
                <h3>{{ product.name }}</h3>
                <p>{{ product.description }}</p>
                <div class="material">
                    <h4>MATERIAL: <span>{{ product.material }}</span></h4>
                    <h4>DESIGNER: <span>{{ product.designer }}</span></h4>
                </div>
                <h3 class="cost">$ {{ product.price }}.00</h3>
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
                        <input type="number" v-model.number="computedProduct.quantity" name="selectQuantity" required>
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
    `,
    mounted() {
        fetch(`/api/product/?id=${window.location.search.replace("?id=", "")}`)
            .then((response) => {
                this.response = response.status;
                return response.json();
            })
             .then((result) => {
            //     fetch(`${API_URL}/stock/${result.currentProduct}`)
            //         .then((response) =>
            //             response.json()
            //         )
            //         .then((result) => {
            //             this.product = result;
            //             this.product.quantity = 1;
            //             this.computedProduct = Object.assign({}, this.product);
            //         });
                 this.product = result;
                 this.product.quantity = 1;
                 this.computedProduct = Object.assign({}, this.product);
             });
    },
    methods: {
        handleBuy() {
            this.computedProduct.color = event.target.selectColor.value;
            this.computedProduct.size = event.target.selectSize.value;
            this.$emit('handlebuy', this.computedProduct);
        },
    },
});

Vue.component('cart-list', {
    data() {
        return {
            cart: [],
            total: 0,
        };
    },
    template: `
    <div class="shoppingCart">
        <div class="container">
            <div  v-if="cart.length !== 0">
            <div class="row shopCartHeading">
                <div class="col-md-4 details">PRODUCT DETAILS</div>
                <div class="col-md-2">UNIT PRICE</div>
                <div class="col-md-2">QUANTITY</div>
                <div class="col-md-1">SHIPPING</div>
                <div class="col-md-2">SUBTOTAL</div>
                <div class="col-md-1">ACTION</div>
            </div>
            <cart-product @deleteClick="deleteFromCart" v-for="product in cart" :product="product"></cart-product>
            <div class="shopCartButtons">
                <div class="row container">
                    <div><a href="/cart/deletecart/"><button>CLEAR SHOPPING CART</button></a></div>
                    <div><a href="/product/catalog/?p=1"><button>CONTINUE SHOPPING</button></a></div>
                </div>
            </div>
            <div class="container">
                <div class="row shipping">
                    <div class="col-xl-4 col-md-6 col-sm-12 address">
                        <h4>SHIPPING ADDRESS</h4>
                        <form>
                            <input type="text" placeholder="Bangladesh">
                            <input type="text" placeholder="State">
                            <input type="text" placeholder="Postcode/ZIP">
                            <button>GET A QUOTE</button>
                        </form>
                    </div>
                    <div class="col-xl-4 col-md-6 col-sm-12 coupon">
                        <h4>COUPON DISCOUNT</h4>
                        <p>Enter your coupon code if you have one</p>
                        <form>
                            <input type="text" placeholder="State">
                            <button>APPLY COUPON</button>
                        </form>
                    </div>
                    <div class="col-xl-4 col-md-12 col-sm-12 total">
                        <p>SUB TOTAL $ {{ this.total }}.00</p>
                        <h5>GRAND TOTAL <span>$ {{ this.total }}.00</span></h5>
                        <img src="/images/line.png" alt="line">
                        <a href="http://localhost:3000/checkout.html"><button>PROCEED TO CHECKOUT</button></a>
                    </div>
                </div>
            </div>
            </div>
            <div class="cartLayoutEmpty" v-if="cart.length === 0">
                CART IS EMPTY
            </div>
        </div>
    </div>
    `,
    mounted() {
        fetch(`/api/getcart/`)
            .then((response) =>
                response.json()
            )
            .then((result) => {
                this.cart = result;
                this.total = this.cart.reduce((acc, product) => acc + product.price * product.quantity, 0);
            });
    },
    methods: {
        deleteFromCart(product) {
            fetch(`/cart/deletefromcart/?id=${product.id}`)
                .then((response) => response.json())
                .then((result) => {
                    app.$refs.count.innerText = result.count;
                    this.cart = result.cart;
                    this.total = this.cart.reduce((acc, product) => acc + product.price * product.quantity, 0);
                });
        },
    },
});

Vue.component('cart-product', {
    props: ['product'],
    template: `
    <div class="row shopCartProduct">
        <div class="col-md-4 article">
            <img :src="/images/ + product.link">
            <article>
                <h4> {{ product.name }} </h4>
                <p>
                    Color: {{ product.color }}<br>
                    Size: {{ product.size }}
                </p>
            </article>
        </div>
        <div class="col-md-2">$ {{ product.price }}.00</div>
        <div class="col-md-2">{{ product.quantity }} pcs.</div>
        <div class="col-md-1">FREE</div>
        <div class="col-md-2">$ {{ product.quantity * product.price }}.00</div>
        <div class="col-md-1"><i class="fas fa-times-circle" @click="deleteFromCart(product)"></i></div>
    </div>
    `,
    methods: {
        deleteFromCart(product) {
            this.$emit('deleteClick', product);
        }
    }
});

Vue.component('error', {
    props: ['response'],
    template: `
    <div class="error" v-if="response !== 200">Ошибка соединения с сервером</div>
    `
});

Vue.component('copy', {
    template: `
    <div class="copy">
        <div class="container">
            <div class="row">
                <div>
                    &copy; 2019 Brand All Rights Reserved.
                </div>
                <div>
                    <a href="#"><img src="/images/facebook.png" alt="facebook"></a>
                    <a href="#"><img src="/images/twitter.png" alt="twitter"></a>
                    <a href="#"><img src="/images/linkedin.png" alt="linkedin"></a>
                    <a href="#"><img src="/images/pinterest.png" alt="pinterest"></a>
                    <a href="#"><img src="/images/googleplus.png" alt="google"></a>
                </div>
            </div>
        </div>
    </div>
    `
});

Vue.component('foot', {
    template: `
    <footer>
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-md-12 information">
                <div class="logo">
                    BRAN<span>D</span>
                </div>
                <p>
                    Objectively transition extensive data rather than cross functional solutions.
                    Monotonectally
                    syndicate multidisciplinary materials before go forward benefits. Intrinsicly syndicate an
                    expanded array of processes and cross-unit partnerships.
                </p>
                <p>
                    Efficiently plagiarize 24/365 action items and focused infomediaries.
                    Distinctively seize superior initiatives for wireless technologies. Dynamically optimize.
                </p>
            </div>
            <div class="col-xl-2 offset-xl-1 col-md-4 links">
                <h4>COMPANY</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">How It Works</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-xl-2 col-md-4 links">
                <h4>INFORMATION</h4>
                <ul>
                    <li><a href="#">Terms & Condition</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">How to Buy</a></li>
                    <li><a href="#">How to Sell</a></li>
                    <li><a href="#">Promotion</a></li>
                </ul>
            </div>
            <div class="col-xl-2 col-md-4 links">
                <h4>SHOP CATEGORY</h4>
                <ul>
                    <li><a href="#">Men</a></li>
                    <li><a href="#">Women</a></li>
                    <li><a href="#">Child</a></li>
                    <li><a href="#">Apparel</a></li>
                    <li><a href="#">Browse All</a></li>
                </ul>
            </div>
        </div>
    </div>
    </footer>
    `
});

Vue.component('foot-banner', {
    data() {
        return {
            reviews: [],
        }
    },
    template: `
   <div class="footBanner">
   <div class="container">
    <div class="row">
        <div class="col-lg-5">
        <div id="carouselReviews" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselReviews" data-slide-to="0" class="active"></li>
            <li data-target="#carouselReviews" data-slide-to="1"></li>
            <li data-target="#carouselReviews" data-slide-to="2"></li>
        </ol>
    <div class="carousel-inner">
        <div class="carousel-item" v-for="(review, index) in reviews" :class="{ 'active': index === 0 }">
            <div class="media">
                <img :src="review.user_avatar" class="align-self-center mr-3" alt="...">
                <div class="media-body">
                    <blockquote>
                        {{ review.text }}
                    </blockquote>
                    <h3>{{ review.user_name }}</h3>
                </div>
            </div>
        </div>
    </div> 
</div>
</div>
<div class="divider"></div>
        <div class="col-lg-5">
            <div class="label">
                <h3>SUBSCRIBE</h3>
                <h4>FOR OUR NEWLETTER AND PROMOTION</h4>
            </div>
            <form>
                <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    </div>
    </div>
   `,
   mounted() {
    fetch(`/api/reviews`)
    .then((response) => {
        this.response = response.status;
        return response.json();
    })
    .then((result) => {
        this.reviews = result;
    });
   },
});

Vue.component('cabinet', {
    props: ["user"],
    data() {
        return {
            review: '',
        };
    },
    template: `
        <div class="container cabinet" v-if="app.activeUserId !== 0">
            <div class="userInfo">
                <h5>user info</h5>
                <img :src="user.link" alt="user_avatar">
                <h6>username: <span>{{ user.name }}</span></h6>
                <h6>email: <span>{{ user.email }}</span></h6>
                <h6>gender: <span>{{ user.gender }}</span></h6>
                <h6>bio:</h6>
                <p>{{ user.bio }}</p>
                <button @click="$('#changeUserModal').modal('show')">CHANGE</button>
            </div>
            <change-user-modal @changeUserInfo="changeUserInfo"></change-user-modal>
            <div class="reviews">
                <h5>user reviews</h5>
                <div class="row">
                    <div class="col-md-2">Review ID</div>
                    <div class="col-md-8">Review text</div>
                    <div class="col-md-2">Action</div>
                </div>    
                <div class="review row" v-for="review in app.reviews" v-if="app.reviews.length !== 0">
                    <div class="col-md-2">{{ review.id }}</div>
                    <div class="col-md-8">{{ review.text }}</div>
                    <div class="col-md-2"><i class="fas fa-times-circle" @click="deleteReview(review)"></i></div>
                </div>
                <div class="review row" v-for="review in app.reviewsToApprove" v-if="app.isAdmin">
                    <div class="col-md-2">{{ review.id }}</div>
                    <div class="col-md-8">{{ review.text }}</div>
                    <div class="col-md-1"><i class="fas fa-check-circle" @click="approveReview(review)"></i></div>
                    <div class="col-md-1"><i class="fas fa-times-circle" @click="deleteReview(review)"></i></div>
                </div>
            </div>
            <div class="addReview">
                <h5>add review</h5>
                <textarea v-model="review"></textarea>
                <button @click="addReview">ADD</button>
            </div>
        </div>
    `,
    methods: {
        deleteReview(review) {
            this.$emit('deletereviewclick', review);
        },
        addReview() {
            this.$emit('addreviewclick', this.review);
            this.review = '';
        },
        approveReview(review) {
            this.$emit('approvereviewclick', review);
        },
        changeUserInfo(changedUserInfo) {
            this.$emit('changeuserinfo', changedUserInfo);
        },
    },
    mounted() {
        fetch(`${API_URL}/reviews`)
            .then((response) => {
                this.response = response.status;
                return response.json();
            })
            .then((result) => {
                this.reviews = result.reviews;
            });
    },
});

Vue.component('change-user-modal', {
    data() {
        return {
            changedUserInfo: {},
        };
    },
    template: `
    <div class="modal fade" id="changeUserModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Change information</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="changeUserInfo(); $('#changeUserModal').modal('hide')">
                <label for="userName">Username</label>
                <input type="text" id="userName" v-model="changedUserInfo.name">
                <label for="password">Password</label>
                <input type="password" id="userPassword" v-model="changedUserInfo.password">
                <label for="userMail">E-mail</label>
                <input type="email" id="userMail" v-model="changedUserInfo.email">
                <label for="gender">Gender</label>
                <input type="radio" name="gender" value="M" checked v-model="changedUserInfo.gender"><span>M</span>
                <input type="radio" name="gender" value="F" v-model="changedUserInfo.gender"><span>F</span>
                <label for="bio">BIO</label>
                <textarea name="bio" v-model="changedUserInfo.bio"></textarea>
                <input type="submit" value ="Save" class="btn btn-primary">
            </form>
          </div>
        </div>
      </div>
    </div>
    `,
    methods: {
        changeUserInfo() {
            this.$emit('changeUserInfo', this.changedUserInfo);
            this.changedUserInfo = {};
        },
    },
});

const app = new Vue({
    el: '#app',
    data: {
        mainNav: [
            { name: 'home', link: "/user/" },
            { name: 'men', link: "/product/catalog/?p=1" },
            { name: 'women', link: "/product/catalog/?p=1" },
            { name: 'kids', link: "/product/catalog/?p=1" },
            { name: 'accessoriese', link: "/product/catalog/?p=1" },
            { name: 'featured', link: "/product/catalog/?p=1" },
            { name: 'hot deals', link: "/product/catalog/?p=1" },
        ],
        product: {},
        currentProduct: 0,
        reviews: [],
        reviewsToApprove: [],
        search: '',
        response: '',

    },
    mounted() {
        // fetch(`${API_URL}/preferences`)
        //     .then((response) => {
        //         this.response = response.status;
        //         return response.json();
        //     })
        //     .then((result) => {
        //         this.isLogin = result.isLogin;
        //         this.activeUserId = result.user_id;
        //         this.isAdmin = result.isAdmin;
        //         fetch(`${API_URL}/cart/${this.activeUserId}`)
        //             .then((response) => {
        //                 this.response = response.status;
        //                 return response.json();
        //             })
        //             .then((result) => {
        //                 this.cart = result.products;
        //                 this.total = result.total;
        //             });
        //         fetch(`${API_URL}/users/${this.activeUserId}`)
        //             .then((response) => {
        //                 this.response = response.status;
        //                 return response.json();
        //             })
        //             .then((result) => {
        //                 this.user = result.user;
        //             });
        //         fetch(`${API_URL}/reviews/${this.activeUserId}`)
        //             .then((response) => {
        //                 this.response = response.status;
        //                 return response.json();
        //             })
        //             .then((result) => {
        //                 this.reviews = result.reviews;
        //                 this.reviewsToApprove = result.reviewsToApprove;
        //             });
        //     });
    },
    methods: {
        handleSearch(query) {
            this.search = query;
        },
        handleBuy(product) {
            fetch(`/cart/addcart/?id=${product.id}&quantity=${product.quantity}`)
                            .then((response) => response.json())
                            .then((result) => {
                                this.$refs.count.innerText = result.count;
                            });
        },
        addReview(review) {
            fetch(`${API_URL}/reviews`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ user_id: this.activeUserId, user_name: this.user.name, user_avatar: this.user.link, text: review, isApproved: false }),
            })
                .then((response) => response.json())
                .then((result) => {
                    this.reviews = result.reviews;
                    this.reviewsToApprove = result.reviewsToApprove;
                });
        },
        deleteReview(review) {
            fetch(`${API_URL}/reviews/${this.activeUserId}/${review.id}`, {
                method: 'DELETE',
            }).then((response) => response.json())
                .then((result) => {
                    this.reviews = result.reviews;
                    this.reviewsToApprove = result.reviewsToApprove;
                });
        },
        approveReview(review) {
            fetch(`${API_URL}/reviews/${review.id}`, {
                method: 'PATCH',
            }).then((response) => response.json())
                .then((result) => {
                    this.reviewsToApprove = result.reviewsToApprove;
                });
        },
        changeUserInfo(user) {
            fetch(`${API_URL}/users/${this.activeUserId}`, {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ user })
            })
                .then((response) => response.json())
                .then((result) => {
                  this.user = result.user;
                });
        },
    }
});