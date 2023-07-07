<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | We need an API key in order to run the requests. You can get one from:
    | https://platform.openai.com/signup
    |
    | If you're using ChatGPT 4 you'll need to ensure you have access to the
    | API first.
    */

    //'api_key' => env('OPENAI_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Organization
    |--------------------------------------------------------------------------
    |
    | If you would like to utilize OpenAI's organization features then you can add
    | it to your env file or override here. This is optional and not required.
    |
    */

    'organization' => env('OPENAI_ORGANIZATION'),

    /*
    |--------------------------------------------------------------------------
    | Model
    |--------------------------------------------------------------------------
    |
    | Which model to use. 3.5-turbo is default, but 4 is much better. You will need
    | an API key that supports 4.
    |
    */

    //'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),

    /*
    |--------------------------------------------------------------------------
    | Max tokens
    |--------------------------------------------------------------------------
    |
    | Each model has a token cap. Tokens are roughly short words. 4096 is the default
    | for GPT 3.5, but each model has a different cap. Max tokens is made up of both
    | the request and response. You are billed per token.
    |
    */

    //'max_tokens' => env('OPENAI_MAXTOKENS', 4096),

    /*
    |--------------------------------------------------------------------------
    | Preface
    |--------------------------------------------------------------------------
    |
    | You can specify a statement that goes to ChatGPT before it generates a response.
    | This is useful for setting the context of the conversation.
    |
    */

    //'prompt_preface' => env('OPENAI_PREFACE', ''),

];
