<?php
declare(strict_types=1);

namespace App\Api;

use PDO;
use App\Api\WishlistModel;
use App\Api\WishModel;
use Ramsey\Uuid\Uuid;

class ApiRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getWishlist(string $uuid): ?WishlistModel
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM `wishlists` WHERE uuid = :uuid");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, WishlistModel::class);
            return $stmt->fetch(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            throw new Exception("Error adding wishlist: " . $e->getMessage());
        }
    }

    public function getWishes($wishlist_uuid): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT wishes.title, wishes.description, wishes.id FROM `wishes` JOIN wishlists ON wishes.wishlist_uuid = wishlists.uuid WHERE wishlists.uuid = :wishlist_uuid");
            $stmt->bindParam(':wishlist_uuid', $wishlist_uuid);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, WishModel::class);
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            throw new Exception("Error fetching wishes: " . $e->getMessage());
        }
    }

    public function addWishlist($wishlist_data): void
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO `wishlists` (uuid, title, description) VALUES (:uuid, :title, :description)");
            $stmt->bindValue(':uuid', Uuid::uuid4());
            $stmt->bindValue(':title', $wishlist_data['title']);
            $stmt->bindValue(':description', $wishlist_data['description']);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error adding wishlist: " . $e->getMessage());
        }
    }

    public function addWish($wish_data): void
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO `wishes` (wishlist_uuid, title, description) VALUES (:wishlist_uuid, :title, :description)");
            $stmt->bindValue(':wishlist_uuid', $wish_data['wishlist_uuid']);
            $stmt->bindValue(':title', $wish_data['title']);
            $stmt->bindValue(':description', $wish_data['description']);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error adding wish: " . $e->getMessage());
        }
    }

    public function deleteWish(int $id): void
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM `wishes` WHERE id = :id");
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error adding wish: " . $e->getMessage());
        }
    }


}