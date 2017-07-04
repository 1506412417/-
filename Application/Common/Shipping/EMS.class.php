<?php

namespace Common\Shipping;
use Common\Interfaces\I_Shipping;

class EMS implements I_Shipping
{

    public function key()
    {
        return 'EMS';
    }

    public function title()
    {
        return '中国邮政EMS';
    }

    public function price()
    {
        // 距离, 重量, 尺寸, 计算价格.(快递公司确定)
        return 5.4;
    }

}