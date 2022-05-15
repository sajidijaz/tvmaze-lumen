<?php

namespace Tests;

class JsonApiTest extends TestCase
{
    public function testBaseEndpointReturnRequiredError(): void
    {
        $this->get('/')->seeJsonEquals(
            [
                'q' => ["The q field is required."]
            ]
        );
    }

    public function testBaseEndpointReturnInvalidFormatError(): void
    {
        $this->get('/?q=abd$3a')->seeJsonEquals(
            [
                'q' => ["The q format is invalid."]
            ]
        );
    }

    public function testBaseEndpointRequestErrorStatus(): void
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(422, $response->status());
    }

    public function testBaseEndpointRequestStatus(): void
    {
        $response = $this->call('GET', '/?q=deadwood');
        $this->assertEquals(200, $response->status());
    }

    public function testBodyResponse(): void
    {
        $response = $this->call('GET', '/?q=deadwood');
        $content = json_decode($response->getContent());
        $this->assertEquals('Deadwood', $content[0]->show->name);
    }

}
