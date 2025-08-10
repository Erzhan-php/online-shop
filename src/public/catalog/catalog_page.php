<div class="container">
    <h3>Catalog</h3>

    <form action="./profile/handle_profile" method="post">
        <button type="submit">Мой профиль</button>
    </form>

    <form action="handle_basket.php" method="post">
    <button type="button">Корзина</button>
    </form>

    <form action="../addProduct/handle_add_product.php" method="post">
    <button type="button"> Добавить продукты</button>
    </form>

    <div class="card-deck">
        <?php foreach ($products as $products): ?>
            <div class="card text-center">
                <a href="#">
                    <div class="card-header">
                        Hit!
                    </div>
                    <img class="card-img-top" src="<?php echo $products['image_url']; ?>" alt="Card image">
                    <div class="card-body">
                        <p class="card-text text-muted"><?php echo $products['name'];?></p>
                        <a href="#"><h5 class="card-title"><?php echo $products['description'];?></h5></a>
                        <div class="card-footer">
                            <?php echo $products['prise'];?>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>

        <style>
            body {
                font-style: sans-serif;
            }

            a {
                text-decoration: none;
            }

            a:hover {
                text-decoration: none;
            }

            h3 {
                line-height: 3em;
            }

            .card {
                max-width: 16rem;
            }

            .card:hover {
                box-shadow: 1px 2px 10px lightgray;
                transition: 0.2s;
            }

            .card-header {
                font-size: 13px;
                color: gray;
                background-color: white;
            }

            .text-muted {
                font-size: 11px;
            }

            .card-footer{
                font-weight: bold;
                font-size: 18px;
                background-color: white;
            }
        </style>