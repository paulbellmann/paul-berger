<?php

declare(strict_types=1);

namespace App\Controller;

use MiniMVC\Core\Controller;
use MiniMVC\Core\Database;
use MiniMVC\Core\Request;
use MiniMVC\Core\View;
use App\Repository\ItemRepository;

class AnalysisController extends Controller
{
    private ItemRepository $itemRepository;

    public function __construct(Request $request, View $view)
    {
        parent::__construct($request, $view);
        $this->itemRepository = new ItemRepository(new Database());
    }

    public function index(): string
    {
        $stats = $this->itemRepository->getAnalasisData();

        // Prepare data for view
        $data = [];
        foreach ($stats as $range => $count) {
            $data[] = [
                'range' => $range,
                'count' => $count
            ];
        }

        return $this->render('analysis', ['title' => 'Statistik', 'data' => $data]);
    }
}
