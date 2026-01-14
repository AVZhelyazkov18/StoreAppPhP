<!DOCTYPE html>
<main class="products-container">
    <h2 class="products-title">Products</h2>

    <div class="products-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img
                        src="views/assets/images/products/<?= $product->get_id()?>.png"
                        alt="Product Image">
                </div>

                <div class="product-info">
                    <div class="product-name">
                        <?=$product->get_name() ?>
                    </div>

                    <div class="product-price">
                        <?= number_format($product->get_price(), 2) ?> €
                        <?= $product->get_unit_type() === 'KG' ? '/kg' : '/pc' ?>
                    </div>

                    <div class="product-stock">
                        Available: <?= number_format($product->get_quantity(), 2) ?>
                        <?= $product->get_unit_type() === 'KG' ? 'kg' : 'pcs' ?>
                    </div>

                    <div class="product-actions">
                        <?php if ($product->get_unit_type() === 'KG'): ?>
                            <input
                                type="number"
                                min="0.01"
                                step="0.01"
                                value="0.10"
                            >
                        <?php else: ?>
                            <input
                                type="number"
                                min="1"
                                step="1"
                                value="1"
                            >
                        <?php endif; ?>

                        <button onclick="addToCart({
                                id: <?= $product->get_id() ?>,
                                name: '<?= addslashes($product->get_name()) ?>',
                                price: <?= $product->get_price() ?>,
                                quantity: parseFloat(this.previousElementSibling.value)
                            })">
                            Buy
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>