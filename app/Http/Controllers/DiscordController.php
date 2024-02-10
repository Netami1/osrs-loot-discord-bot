<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Nwilging\LaravelDiscordBot\Contracts\Services\DiscordInteractionServiceContract;

class DiscordController extends Controller
{
    private DiscordInteractionServiceContract $interactionService;

    public function __construct(DiscordInteractionServiceContract $interactionService)
    {
        $this->interactionService = $interactionService;
    }

    public function handleDiscordInteraction(Request $request): JsonResponse
    {
        $response = $this->interactionService->handleInteractionRequest($request);
        return response()->json($response->toArray(), $response->getStatus());
    }
}
