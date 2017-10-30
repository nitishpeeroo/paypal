<!Doctype html>
<html>
    <head>
        <title>Ma boutique</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
        <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    </head>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Lien 1</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="container">
        <h1>Récapitulatif</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'src/Basket.php';
                require 'src/Product.php';
                foreach (nitish\Basket::fake()->getProducts() as $product):
                    ?>
                    <tr>
                        <td><?= $product->getName(); ?></td>
                        <td><?= $product->getPrice(); ?></td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

        <div  class="text-right" id="paypal-button"></div>

    </div>  
    <script>
        paypal.Button.render({

            env: 'sandbox', // Or 'sandbox or production',

            commit: true,
            locale: 'fr_FR',
            style: {
                size: 'small',
                color: 'blue',
                shape: 'pill',
                label: 'checkout'
            },
            payment: function () {
                return paypal.request.post('payment.php').then(function (data) {
                    return data.id;
                });
            },

            onAuthorize: function (data, actions) {
                return paypal.request.post('pay.php', {
                paymentID: data.paymentID,
                        payerID:   data.payerID
                }).then(function(data) {
                console.log(data);
                        alert("Merci pour votre achat")
                }).catch (function(err){
                    console.log('erreur', err)
                });
                
            }

        }, '#paypal-button');
    </script>
</html>