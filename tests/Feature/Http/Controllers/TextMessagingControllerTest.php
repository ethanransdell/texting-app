<?php

namespace Tests\Feature\Http\Controllers;

use App\TextMessage;
use App\User;
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
                    'id'         => $textMessage->id,
                    'message_id' => $textMessage->message_id,
                    'to'         => $textMessage->to,
                    'from'       => $textMessage->from,
                    'body'       => $textMessage->body,
                    'user_id'    => $user->id,
                    'created_at' => $textMessage->created_at->toISOString(),
                    'updated_at' => $textMessage->updated_at->toISOString(),
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

        $this->instance(TextMessagingInterface::class, $textMessaging);

        $response = $this
            ->actingAs(factory(User::class)->create())
            ->post('/api/text-messaging/send', $messageData);

        /** @var TextMessage $textMessage */
        $textMessage = TextMessage::query()
            ->where('message_id', '=', $messageData['message_id'])
            ->first();

        $response
            ->assertSuccessful()
            ->assertJson($textMessage->attributesToArray());
    }
}
