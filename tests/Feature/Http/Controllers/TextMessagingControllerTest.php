<?php

namespace Tests\Feature\Http\Controllers;

use App\TextMessage;
use App\User;
use Illuminate\Support\Str;
use Mockery;
use Tests\TestCase;
use TextMessaging\TextMessageModel;
use TextMessaging\TextMessagingInterface;

class TextMessagingControllerTest extends TestCase
{
    public function testAll_Unauthenticated()
    {
        $response = $this->get('/api/text-messaging');

        $response->assertRedirect(route('login'));
    }

    public function testAll()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        /** @var TextMessage $textMessage */
        $textMessage = factory(TextMessage::class)->make();

        $user
            ->textMessages()
            ->save($textMessage);

        $response = $this
            ->actingAs($user)
            ->get('/api/text-messaging');

        $response
            ->assertSuccessful()
            ->assertJson([
                [
                    'id'           => $textMessage->id,
                    'message_id'   => $textMessage->message_id,
                    'to'           => $textMessage->to,
                    'from'         => $textMessage->from,
                    'body'         => $textMessage->body,
                    'user_id'      => (int)$user->id,
                    'service_name' => $textMessage->service_name,
                    'status'       => $textMessage->status,
                    'created_at'   => $textMessage->created_at->toISOString(),
                    'updated_at'   => $textMessage->updated_at->toISOString(),
                ],
            ]);
    }

    public function testSend()
    {
        $messageData = factory(TextMessage::class)
            ->make()
            ->attributesToArray();

        $messageDto = new TextMessageModel();
        $messageDto->messageId = $messageData['message_id'];
        $messageDto->to = $messageData['to'];
        $messageDto->from = $messageData['from'];
        $messageDto->body = $messageData['body'];

        $textMessaging = Mockery::mock(TextMessagingInterface::class);

        $textMessaging
            ->shouldReceive('send')
            ->once()
            ->andReturn($messageDto);

        $serviceName = Str::random();

        $textMessaging
            ->shouldReceive('getServiceName')
            ->andReturn($serviceName);

        $this->instance(TextMessagingInterface::class, $textMessaging);

        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->post('/api/text-messaging/send', $messageData);

        /** @var TextMessage $textMessage */
        $textMessage = TextMessage::query()
            ->where('message_id', '=', $messageData['message_id'])
            ->first();

        $messageData['user_id'] = $user->id;
        $messageData['service_name'] = $textMessaging->getServiceName();

        $response
            ->assertSuccessful()
            ->assertJson($textMessage->attributesToArray());
    }

    public function testRefresh()
    {
        $statusOne = $this->faker->unique()->word;
        $statusTwo = $this->faker->unique()->word;

        /** @var User $user */
        $user = factory(User::class)->create();

        /** @var TextMessage $textMessage */
        $textMessage = factory(TextMessage::class)->make(['status' => $statusOne]);

        $user
            ->textMessages()
            ->save($textMessage);

        $newDto = new TextMessageModel();
        $newDto->messageId = $textMessage->id;
        $newDto->to = $textMessage->to;
        $newDto->from = $textMessage->from;
        $newDto->body = $textMessage->body;
        $newDto->status = $statusTwo;

        $textMessaging = Mockery::mock(TextMessagingInterface::class);

        $textMessaging
            ->shouldReceive('get')
            ->once()
            ->andReturn($newDto);

        $textMessaging
            ->shouldReceive('getServiceName')
            ->andReturn($textMessage->service_name);

        $this->instance(TextMessagingInterface::class, $textMessaging);

        $response = $this
            ->actingAs($user)
            ->post('/api/text-messaging/' . $textMessage->id . '/refresh');

        $textMessage = $textMessage->refresh();

        $this->assertEquals($textMessage->status, $statusTwo);

        $response
            ->assertSuccessful()
            ->assertJson([
                'id'           => $textMessage->id,
                'message_id'   => $textMessage->message_id,
                'to'           => $textMessage->to,
                'from'         => $textMessage->from,
                'body'         => $textMessage->body,
                'user_id'      => (int)$user->id,
                'service_name' => $textMessage->service_name,
                'status'       => $textMessage->status,
                'created_at'   => $textMessage->created_at->toISOString(),
                'updated_at'   => $textMessage->updated_at->toISOString(),
            ]);
    }
}
