<?php

$product = $response['data'];

?>

<article>
    <h1 id="article"><?= $product->getName() ?></h1>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam iste distinctio dolorem,</p>
    <p>illum quia optio doloremque aperiam debitis in a quod sit suscipit dolorum possimus excepturi<br />
    neque voluptatem autem corrupti.</p>
    <p>
        <?= $product->getPrice(true) ?>&euro;
    </p>
    <p>
        <a href="">Ajouter au panier</a>
    </p>
</article>        
