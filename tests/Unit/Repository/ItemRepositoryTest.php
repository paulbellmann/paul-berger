<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Repository\ItemRepository;
use App\Model\ItemModel;
use MiniMVC\Core\Database;

class ItemRepositoryTest extends TestCase
{
    private ItemRepository $repo;
    private Database $db;

    protected function setUp(): void
    {
        $this->db = $this->createMock(Database::class);
        $this->repo = new ItemRepository($this->db);
    }

    public function testFindByIdReturnsItemModel(): void
    {
        $itemData = ['id' => '1', 'name' => 'Test', 'price' => 100];
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('fetch')->willReturn($itemData);
        $this->db->method('getConnection')->willReturn($this->createMock(PDO::class));
        $this->repo = $this->getMockBuilder(ItemRepository::class)
            ->setConstructorArgs([$this->db])
            ->onlyMethods(['findById'])
            ->getMock();
        $this->repo->method('findById')->willReturn(new ItemModel('1', 'Test', 100));

        $item = $this->repo->findById('1');
        $this->assertInstanceOf(ItemModel::class, $item);
        $this->assertEquals('Test', $item->name);
        $this->assertEquals(100, $item->price);
    }

    public function testFindAllReturnsArrayOfItemModels(): void
    {
        $items = [
            new ItemModel('1', 'Test1', 100),
            new ItemModel('2', 'Test2', 200)
        ];
        $this->repo = $this->getMockBuilder(ItemRepository::class)
            ->setConstructorArgs([$this->db])
            ->onlyMethods(['findAll'])
            ->getMock();
        $this->repo->method('findAll')->willReturn($items);

        $result = $this->repo->findAll();
        $this->assertIsArray($result);
        $this->assertInstanceOf(ItemModel::class, $result[0]);
        $this->assertInstanceOf(ItemModel::class, $result[1]);
    }

    public function testCreateInsertsItem(): void
    {
        $this->repo = $this->getMockBuilder(ItemRepository::class)
            ->setConstructorArgs([$this->db])
            ->onlyMethods(['create'])
            ->getMock();
        $this->repo->expects($this->once())
            ->method('create')
            ->with('3', 'Test3', 300);
        $this->repo->create('3', 'Test3', 300);
    }
}
