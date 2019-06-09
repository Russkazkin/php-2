<?php

namespace app\controllers;


use app\models\Product;

class ProductController extends Controller
{

    public function actionIndex()
    {
        $products = Product::getAll();
        echo $this->render('product/index', ['products' => $products, 'heading' => 'Каталог', 'title' => 'Каталог', ]);
    }

    public function actionCard()
    {
        $id = $this->values[0];
        $product = Product::getOne($id);
        echo $this->render('product/card', ['product' => $product->getTwigArr()]);
    }
}
