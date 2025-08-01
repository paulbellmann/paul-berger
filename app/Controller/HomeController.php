<?php

declare(strict_types=1);

namespace App\Controller;

use MiniMVC\Core\Controller;
use MiniMVC\Core\Database;
use MiniMVC\Core\Request;
use MiniMVC\Core\View;
use App\Repository\ItemRepository;

class HomeController extends Controller
{
    private ItemRepository $itemRepository;

    public function __construct(Request $request, View $view)
    {
        parent::__construct($request, $view);
        $this->itemRepository = new ItemRepository(new Database());
    }

    public function index(): string
    {
        $name = $this->request->get('name');
        $id = $this->request->get('id');

        if ($name !== null || $id !== null) {
            $items = $this->itemRepository->findByNameOrId($id, $name);
            return $this->render('home', ['title' => 'Willkommen', 'items' => $items]);
        }

        $items = $this->itemRepository->findAll();
        return $this->render('home', ['title' => 'Willkommen', 'items' => $items]);
    }
}
