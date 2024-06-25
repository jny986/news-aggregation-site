<?php

use App\Http\Integrations\GuardianConnector;
use App\Http\Requests\GuardianSearchRequest;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;


describe('Guardian news provider', function () {
    test('Can request news', function () {
        $mockClient = Saloon::fake([
            GuardianSearchRequest::class => MockResponse::fixture('guardian-request')
        ]);

        $guardian = GuardianConnector::make(config('services.guardian.api_key'));
        $request = GuardianSearchRequest::make();

        $response = $guardian->send($request);

        $mockClient->assertSent(GuardianSearchRequest::class);
        $mockClient->assertSentCount(1);

        expect($response->successful())
            ->toBeTrue()
            ->and($response->body())
            ->toBeJson()
            ->and($response->object()->response->pageSize)
            ->toBe(10)
            ->and($response->object()->response->results)
            ->toHaveCount(10);
    });

    test('Can search request news', function () {
        $mockClient = Saloon::fake([
            GuardianSearchRequest::class => MockResponse::fixture('guardian-search-request')
        ]);

        $guardian = GuardianConnector::make(config('services.guardian.api_key'));
        $request = GuardianSearchRequest::make();

        $request->query()->add('q', 'Adelaide');

        $response = $guardian->send($request);

        $mockClient->assertSent(GuardianSearchRequest::class);
        $mockClient->assertSentCount(1);

        expect($response->successful())
            ->toBeTrue()
            ->and($response->body())
            ->toBeJson()
            ->and($response->object()->response->pageSize)
            ->toBe(10)
            ->and($response->object()->response->results)
            ->toHaveCount(10)
            ->and($response->object()->response->results[0]->webTitle)
            ->toContain('Adelaide');
    });
});
