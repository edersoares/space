<?php

namespace Dex\Laravel\Space\Extensions\Passport;

use Dex\Laravel\Space\Models\Profile;
use Dex\Laravel\Space\Models\Space;
use Dex\Laravel\Space\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Passport\Http\Controllers\ApproveAuthorizationController as Passport;

class ApproveAuthorizationController extends Passport
{
    public function __invoke(Request $request): Response
    {
        $this->linkToUser($request);

        return parent::approve($request);
    }

    private function linkToUser(Request $request): void
    {
        $client = $request->string('client_id');

        $space = Space::query()
            ->where('client_id', $client->value())
            ->first();

        if (empty($space) || $client->isEmpty()) {
            return;
        }

        /** @var User $user */
        $user = $request->user();

        $user->profiles()->firstOrCreate([
            'space_id' => $space->getKey(),
            'user_id' => $user->getKey(),
        ], [
            'name' => $space->name,
            'token' => 'default',
            'is_default' => !Profile::query()->where('user_id', $user->getKey())->exists(),
        ]);
    }
}
