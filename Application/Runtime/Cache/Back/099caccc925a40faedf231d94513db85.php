<?php if (!defined('THINK_PATH')) exit();?><tr id="tr-product-<?php echo ($product['product_id']); ?>">
    <?php if(is_array($product['optionList'])): $i = 0; $__LIST__ = $product['optionList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$option): $mod = ($i % 2 );++$i;?><td class="text-left">
            <?php echo ($option['option_value']); ?>
        </td><?php endforeach; endif; else: echo "" ;endif; ?>

    <td class="text-right">
        <input type="text" name="product[<?php echo ($product['product_id']); ?>][product_quantity]" id="input-product_quantity-<?php echo ($product['product_id']); ?>" value="<?php echo ($product['product_quantity']); ?>" placeholder="商品数量" class="form-control" />
    </td>
    <td class="text-right">
        <select name="" id="select-price_drift_id-<?php echo ($product['product_id']); ?>" class="form-control">
            <?php if(is_array($priceDriftList)): $i = 0; $__LIST__ = $priceDriftList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$priceDrift): $mod = ($i % 2 );++$i;?><option <?php if($priceDrift['price_drift_id'] == $product['price_drift_id']): ?>selected<?php endif; ?> value="<?php echo ($priceDrift['price_drift_id']); ?>"><?php echo ($priceDrift['title']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <input type="text" name="" id="input-product_price-<?php echo ($product['product_id']); ?>" value="<?php echo ($product['product_price']); ?>" placeholder="销售价格" class="form-control" />
    </td>

    <td class="text-left">
        <input type="checkbox" class="form-control" id="input-promoted-<?php echo ($product['product_id']); ?>" name="" value="1"<?php if($product['promoted']): ?>checked<?php endif; ?>>
    </td>
    <td class="text-left">
        <input type="checkbox" class="form-control" id="input-enabled-<?php echo ($product['product_id']); ?>" name="" value="1"<?php if($product['enabled']): ?>checked<?php endif; ?>>
    </td>
    <td>
        <a href="" id="" class="btn btn-default">删</a>
        <a href="" id="" class="btn btn-default">更</a>

    </td>
</tr>