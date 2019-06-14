<?php

namespace app\controllers;


use app\models\Product;

class ProductController extends Controller
{

    public function actionIndex()
    {
        $products = Product::getAll();
        $this->title = 'Каталог';
        echo $this->render('product/index', ['products' => $products, 'heading' => 'Каталог']);
    }

    public function actionCard()
    {
        $id = $this->values[0];
        $product = Product::getOne($id);
        $this->title = $product->getProp('name');
        echo $this->render('product/card', [
            'product' => $product->getTwigArr(),
            'id' => $product->getProp('id')
        ]);
    }
}
