<?php

namespace Common\Shipping;
use Common\Interfaces\I_Shipping;

class YunDa implements I_Shipping
{

    public function key()
    {
        return 'YunDa';
    }

    public function title()
    {
        return '韵达';
    }

    public function price()
    {
        // 距离, 重量, 尺寸, 计算价格.(快递公司确定)
        return 8.6;
    }

}