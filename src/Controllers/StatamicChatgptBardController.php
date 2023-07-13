<?php

namespace Bitdigital\StatamicChatgpt\Controllers;

use Illuminate\Http\Request;;
use Illuminate\Validation\Rule;
use Bitdigital\StatamicChatgpt\Services\OpenAIService;
use Tiptap\Editor;

class StatamicChatgptBardController
{
    public function handle(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', Rule::in(['full', 'paragraph'])],
            'promptText' => ['required'],
        ]);

        // Load our OpenAI service
        $openAIService = new OpenAIService;

        // Fire the prompt
        try {
            $response = $openAIService->generateContentFromPrompt($validated['promptText'], $validated['type']);
        } catch(\OpenAI\Laravel\Exceptions\ApiKeyIsMissing $e) {
            return ['error' => 'You haven\'t added your API key yet, or you are using an API key not compatible with the model selected. Click "ChatGPT" in the left menu to add your API key.'];
        } catch (\Exception $e) {
            $message = $e->getMessage();
            if($message === 'you must provide a model parameter') {
                return ['error' => 'You haven\'t selected a model from the settings screen. Click ChatGPT on the left menu, and choose a model to use.'];
            }

            if(str_starts_with($message, 'cURL error 28: Operation timed out after')) {
                return ['error' => 'It looks like the OpenAI API timed out. This can sometimes happen, try it again. If the error persists please check OpenAI status: https://status.openai.com/'];
            }

            return ['error' => $e->getMessage(), 'code' => $e->getCode(), 'type' => get_class($e)];
        }

        // Create an editor instance and load the OpenAI response into the editor to get the HTML, then return it to our Vue component
        $editorHTML = (new Editor)
            ->setContent($response)
            ->getHTML();

        return ['text' => $editorHTML];
    }
}
