<?php

declare(strict_types=1);

namespace App\Repository;

use MiniMVC\Core\Database;
use App\Model\ItemModel;

class ItemRepository
{
    private Database $database;

    public function __construct(private Database $db)
    {
        $this->database = $db;
    }

    /**
     * @return ItemModel[]
     */
    public function findAll(): array
    {
        $statement = $this->database->getConnection()->query('SELECT * FROM item');
        $items = [];

        foreach ($statement->fetchAll() as $data) {
            $items[] = new ItemModel($data['id'], $data['name'], $data['price']);
        }

        return $items;
    }

    public function findById(string $id): ?ItemModel
    {
        $statement = $this->database->getConnection()->prepare('SELECT * FROM item WHERE id = ?');
        $statement->execute([$id]);

        $data = $statement->fetch();
        if (!$data) {
            return null;
        }

        return new ItemModel($data['id'], $data['name'], $data['price']);
    }

    public function deleteById(string $id): void
    {
        $statement = $this->database->getConnection()->prepare('DELETE FROM item WHERE id = ?');
        $statement->execute([$id]);
    }

    public function updateById(string $id, string $name, int $price): void
    {
        $statement = $this->database->getConnection()->prepare('UPDATE item SET name = ?, price = ? WHERE id = ?');
        $statement->execute([$name, $price, $id]);
    }

    /**
     * @return ItemModel[]
     */
    public function findByNameOrId(string $id, string $name): array
    {
        $query = 'SELECT * FROM item WHERE id = ?';
        $params = [$id];

        if ($name !== '') {
            $query .= ' OR name LIKE ?';
            $params[] = '%' . $name . '%';
        }

        $statement = $this->database->getConnection()->prepare($query);
        $statement->execute($params);

        $items = [];
        foreach ($statement->fetchAll() as $data) {
            $items[] = new ItemModel($data['id'], $data['name'], $data['price']);
        }

        return $items;
    }

    public function getAnalasisData(): array
    {
        $items = $this->findAll();

        $stats = [];
        foreach ($items as $item) {
            $range = substr((string)$item->id, 0, 2);
            if (!isset($stats[$range])) {
                $stats[$range] = 0;
            }
            $stats[$range]++;
        }


        return $stats;
    }

    public function create(string $id, string $name, int $price): void
    {
        $db = $this->database->getConnection();

        $statement = $db->prepare('INSERT INTO item (id, name, price) VALUES (?, ?, ?)');
        $statement->execute([$id, $name, $price]);
    }
}
