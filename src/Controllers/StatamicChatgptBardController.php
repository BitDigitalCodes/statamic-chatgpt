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
        $response = $openAIService->generateContentFromPrompt($validated['promptText'], $validated['type']);

        // Create an editor instance and load the OpenAI response into the editor to get the HTML, then return it to our Vue component
        $editorHTML = (new Editor)
            ->setContent($response)
            ->getHTML();

        return ['text' => $editorHTML];
    }
}
