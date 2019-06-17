<?php

namespace app\controllers;


use app\models\repositories\ProductRepository;

class ProductController extends Controller
{

    public function actionIndex()
    {
        $products = (new ProductRepository())->getAll();
        $this->title = 'Каталог';
        echo $this->render('product/index', ['products' => $products, 'heading' => 'Каталог']);
    }

    public function actionCard()
    {
        $id = $this->param;
        $product = (new ProductRepository())->getOne($id);
        if(!$product){
            throw new \Exception('Product not found', 404);
        }
        $this->title = $product->getProp('name');
        echo $this->render('product/card', [
            'product' => $product->getTwigArr(),
            'id' => $product->getProp('id')
        ]);
    }
}
