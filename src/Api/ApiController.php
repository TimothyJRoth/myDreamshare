<?php

namespace App\Api;

use AllowDynamicProperties;
use Ramsey\Uuid\Uuid;

#[AllowDynamicProperties] class ApiController
{

    public function __construct(ApiRepository $apiRepository)
    {
        $this->apiRepository = $apiRepository;
    }

    public function documentation(): void
    {
        require('src/Views/documentation.php');
        return;
    }

    private function api_key_is_valid(): bool
    {
        $apiKey = $_SERVER['HTTP_API_KEY'] ?? null;
        $validApiKey = '9dRd7iPqLCh,"tKoF!lxZ3#-]';

        return $apiKey === $validApiKey;
    }

    private function set_cors_headers(): void
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, API-Key");
    }

    /**
     * @throws \JsonException
     */
    private function validate_api_key(): bool
    {
        $this->set_cors_headers();
        header('Content-Type: application/json');

        if (!$this->api_key_is_valid()) {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode(['error' => 'Invalid API key'], JSON_THROW_ON_ERROR);
            return false;
        }

        return true;
    }

    /**
     * @throws \JsonException
     */
    private function render_json_response($content): void
    {
        if (!$this->validate_api_key()) {
            return;
        }

        if (empty($content)) {
            echo json_encode(["content" => "empty"], JSON_THROW_ON_ERROR);
            return;
        }

        echo json_encode($content, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws \JsonException
     */
    public function getWishes(string $wishlist_uuid): void
    {

        if (!$this->validate_api_key()) {
            return;
        }

        $this->render_json_response($this->apiRepository->getWishes($wishlist_uuid));

    }

    /**
     * @throws \JsonException
     */
    public function getWishlist(string $uuid): void
    {

        if (!$this->validate_api_key()) {
            return;
        }

        $this->render_json_response($this->apiRepository->getWishlist($uuid));

    }

    /**
     * @throws \JsonException
     */
    public function addWishlist(): void
    {

        if (!$this->validate_api_key()) {
            return;
        }

        $json_data = file_get_contents("php://input");
        $wishlist_data = json_decode($json_data, true, 512, JSON_THROW_ON_ERROR);
        $this->apiRepository->addWishlist($wishlist_data);

    }

    /**
     * @throws \JsonException
     */
    public function addWish(): void
    {

        if (!$this->validate_api_key()) {
            return;
        }

        $json_data = file_get_contents("php://input");
        $wish_data = json_decode($json_data, true, 512, JSON_THROW_ON_ERROR);
        $this->apiRepository->addWish($wish_data);

    }


    /**
     * @throws \JsonException
     */
    public function deleteWish(int $id): void
    {

        if (!$this->validate_api_key()) {
            return;
        }

        $this->apiRepository->deleteWish($id);
        $this->render_json_response(["deleted" => "true"]);

    }
}
