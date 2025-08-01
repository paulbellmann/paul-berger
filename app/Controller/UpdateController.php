<?php

declare(strict_types=1);

namespace App\Controller;

use MiniMVC\Core\Controller;
use MiniMVC\Core\Database;
use MiniMVC\Core\Request;
use MiniMVC\Core\View;
use App\Repository\ItemRepository;

class UpdateController extends Controller
{
    private ItemRepository $itemRepository;

    public function __construct(Request $request, View $view)
    {
        parent::__construct($request, $view);
        $this->itemRepository = new ItemRepository(new Database());
    }

    public function index(string $id)
    {
        $name = $this->request->get('name');
        $price = $this->request->get('price');

        if (empty($id) || empty($name) || !is_numeric($price)) {
            return $this->render('error', ['message' => 'Falsche Eingabe']);
        }

        $this->itemRepository->updateById($id, $name, (int)$price);
        $this->redirect('/');
    }
}
