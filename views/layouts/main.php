<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/style/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/vue.js"></script>
    <title>Document</title>
</head>
<body>


<div id="app">

    <div class="container">
        <header>
            <div class="headerInside row no-gutters">
                <div class="logo col-lg-3 col-md-3">
                    BRAN<span>D</span>
                </div>
                <search-field @searchclick="handleSearch"></search-field>

                <div class="account col-lg-3 offset-lg-2 col-md-3">
                    <a href="/cart/"><img src="/images/cart.png" alt="cart"></a>
                    <span class="count"><?= $count ?></span>
                    <button id="myAcc" type="button" class="myAcc btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Account
                    </button>
                    <?php if ($username === 'guest'): ?>
                    <div class="dropdown-menu" aria-labelledby="myAcc">
                        <a class="dropdown-item" onclick="$('#loginModal').modal('show')">Log In</a>
                        <a class="dropdown-item" onclick="$('#registerModal').modal('show')">Register</a>
                    </div>
                    <?php else: ?>
                    <div class="dropdown-menu" aria-labelledby="myAcc">
                        <a class="dropdown-item" href="/user/cabinet/">Cabinet</a>
                        <?php if ($admin): ?>
                            <a class="dropdown-item" href="/user/admin/">Admin Page</a>
                        <?php endif ?>
                        <a class="dropdown-item" href="/user/logout/">Log Out</a>
                    </div>
                    <?php endif ?>
                    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Log In</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/user/login/" method="post">
                                        <label for="inputLogin">Login*</label>
                                        <input type="text" class="form-control" id="inputLogin" placeholder="Enter login" required name="login">
                                        <label for="inputPassword">Password*</label>
                                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" required name="pass">
                                        <p>* Required Fields</p>
                                        <input type="submit" value ="Log In" class="btn btn-primary" name="send">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Registration</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form @submit.prevent="handleRegister(user); $('#registerModal').modal('hide')">
                                        <label for="login">LOGIN*</label>
                                        <input type="text" v-model="user.login" name="login" required>
                                        <label for="password">PASSWORD*</label>
                                        <input type="password" v-model="user.password" name="password" required>
                                        <p>* Required Fields</p>
                                        <input type="submit" value ="Register" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </header>
    </div>
    <div class="container">
        <ul class="nav nav-pills nav-fill mainNav">
            <li v-for="menuItem in mainNav" class="nav-item">
                <a :href="menuItem.link" class="nav-link">{{ menuItem.name }}</a>
            </li>
        </ul>
    </div>
  <!--  <ul class="nav justify-content-center mt-2">

        <?php if ($username != 'guest')  :?>
        <li class="nav-item">
            <a class="nav-link" href="/user/cabinet/">Cabinet</a>
        </li>
            <?php if ($admin)  :?>
        <li class="nav-item">
            <a class="nav-link" href="/user/admin">Admin page</a>
        </li>
        <?php endif ?>
        <li class="nav-item">
            <a class="nav-link" href="/user/logout">Logout</a>
        </li>
        <?php endif ?>
    </ul> -->
    <?=$content?>

    <foot-banner></foot-banner>
    <foot></foot>
    <copy></copy>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="/script.js"></script>
</body>
</html>

