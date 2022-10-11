<?php

namespace App\Service;

class ProductHandler
{

    private $products = [
//        [
//            'id' => 1,
//            'name' => 'Coca-cola',
//            'type' => 'Drinks',
//            'price' => 10.01,
//            'create_at' => '2021-04-20 10:00:00',
//        ],
//        [
//            'id' => 2,
//            'name' => 'Persi',
//            'type' => 'Drinks',
//            'price' => 5.25,
//            'create_at' => '2021-04-21 09:00:00',
//        ],
//        [
//            'id' => 3,
//            'name' => 'Ham Sandwich',
//            'type' => 'Sandwich',
//            'price' => 45.88,
//            'create_at' => '2021-04-20 19:00:00',
//        ],
//        [
//            'id' => 4,
//            'name' => 'Cup cake',
//            'type' => 'Dessert',
//            'price' => 35.99,
//            'create_at' => '2021-04-18 08:45:00',
//        ],
//        [
//            'id' => 5,
//            'name' => 'New York Cheese Cake',
//            'type' => 'Dessert',
//            'price' => 40.99,
//            'create_at' => '2021-04-19 14:38:00',
//        ],
//        [
//            'id' => 6,
//            'name' => 'Lemon Tea',
//            'type' => 'Drinks',
//            'price' => 8.88,
//            'create_at' => '2021-04-04 19:23:00',
//        ],
    ];


    public function __construct(array $products = [])
    {
        $this->products = $products;
    }

    /**
     * 计算总金额
     * @return float|int
     */
    public function getTotalPrice()
    {
        if(empty($this->products)){
            return 0;
        }
        return array_sum(array_column($this->products,'price'));
    }

    /**
     * 筛选
     * @param $key string 筛选的项
     * @param $value string 筛选的值
     * @param $order string 排序字段
     * @param $sort string 1:升序,2:降序
     * @return array
     */
    function search($key = 'type', $value = 'Dessert', $order = 'price', $sort = 2)
    {
        if(empty($this->products)){
            return [];
        }
        if(!in_array($sort,[1,2])){
            return [];
        }
        $products = array_filter($this->products, function($product) use ($key,$value) {
            return $product[$key] == $value;
        });
        $func = $sort  == 2 ? 'uasort' : 'usort';

        $func($products, function($next, $prev) use ($order,$sort) {
            return $sort == 2 ? bccomp($prev[$order],$next[$order]) : bccomp($next[$order],$prev[$order]);
        });
        return $products;
    }

    /**
     * 转换时间
     * @return array[]
     */
    public function conversionUnix()
    {
        if(empty($this->products)){
            return [];
        }
        foreach ($this->products as &$item) {
            $item['create_at'] = strtotime($item['create_at']);
            if($item['create_at'] === false) { //不是时间格式
                $item['create_at'] = 0;
            }
        }
        return $this->products;
    }
}