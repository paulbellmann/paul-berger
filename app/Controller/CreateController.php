<?php

declare(strict_types=1);

namespace App\Controller;

use MiniMVC\Core\Controller;
use MiniMVC\Core\Database;
use MiniMVC\Core\Request;
use MiniMVC\Core\View;
use App\Repository\ItemRepository;

class CreateController extends Controller
{
    private ItemRepository $itemRepository;

    public function __construct(Request $request, View $view)
    {
        parent::__construct($request, $view);
        $this->itemRepository = new ItemRepository(new Database());
    }

    public function index(): string
    {
        $id = $this->request->get('id');
        $name = $this->request->get('name');
        $price = $this->request->get('price');

        if (!$id || !$name || !$price) {
            http_response_code(400);
            return $this->render('error', ['message' => 'ID, Name, and Price are required']);
        }

        $this->itemRepository->create($id, $name, (int) $price);

        return $this->render('create', ['message' => 'Erfolgreich angelegt']);
    }
}
