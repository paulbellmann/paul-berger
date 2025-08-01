<?php

declare(strict_types=1);

namespace App\Controller;

use MiniMVC\Core\Controller;
use MiniMVC\Core\Database;
use MiniMVC\Core\Request;
use MiniMVC\Core\View;
use App\Repository\ItemRepository;

class ReadController extends Controller
{
    private ItemRepository $itemRepository;

    public function __construct(Request $request, View $view)
    {
        parent::__construct($request, $view);
        $this->itemRepository = new ItemRepository(new Database());
    }

    public function index(string $id): string
    {
        $item = $this->itemRepository->findById($id);

        return $this->render('read', ['title' => 'Artikel Bearbeiten', 'item' => $item]);
    }
}
