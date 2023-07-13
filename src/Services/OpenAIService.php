<?php

namespace Bitdigital\StatamicChatgpt\Services;
use OpenAI\Laravel\Facades\OpenAI;

class OpenAIService {

    /**
     * @param string $title
     * @param string $type
     * @return string
     */
    public function generateContentFromPrompt(string $title, string $type): string
    {
        config([
            'openai.api_key' => config('statamic-chatgpt.api_key'),
            'openai.organization' => config('statamic-chatgpt.organization'),
            'openai.request_timeout' => 120,
        ]);

        if($type === 'full') {
            $lengthPrompt = 'You write full articles, at least 1,000 words long. Use titles and subtitles where appropriate.';
            $finalPrompt = 'Write me an SEO optimised article, with links to relevant websites included called: '. $title;
        } else {
            $lengthPrompt = 'Write me a single paragraph only.';
            $finalPrompt = 'Write me a single paragraph about: '. $title;
        }

        // Calculate the used tokens in the prompt
        $tokenChars = strlen($lengthPrompt)
            + strlen($finalPrompt)
            + strlen(config('statamic-chatgpt.prompt_preface'))
            + strlen($title)
            + 100; // Add a small buffer, as the 4 character split is an approximation

        // Calculate the number of tokens used
        $tokens = ceil($tokenChars / 4);

        $messages = [];
        if(config('statamic-chatgpt.prompt_preface')) {
            $messages[] = ['role' => 'system', 'content' => config('statamic-chatgpt.prompt_preface')];
        }
        $messages[] = ['role' => 'system', 'content' => $lengthPrompt];
        $messages[] = ['role' => 'system', 'content' => 'Return the response as HTML'];
        $messages[] = ['role' => 'user', 'content' => $finalPrompt];

        // Get the result from OpenAI
        $result = OpenAI::chat()->create([
            'model' => config('statamic-chatgpt.model'),
            'max_tokens' => config('statamic-chatgpt.max_tokens')-$tokens,
            'messages' => $messages,
        ]);

        return $this->cleanResult($result['choices'][0]['message']['content'] ?? '');
    }

    /**
     * Various non-UTF8 characters get returned from OpenAI, so we need to clean them up.
     * This function converts encoding to UTF8 and then manually cleans up any erroneous characters.
     *
     * @param $content
     * @return string
     */
    public function cleanResult($content=''): string
    {
        $content = mb_convert_encoding($content, 'UTF-8');
        $content = trim($content, '"');
        $content = str_replace("'", "'", $content);
        $content = str_replace("â", "'", $content);
        $content = str_replace("  ", " ", $content);
        $content = str_replace("â", "&", $content);
        $content = str_replace("'", '-', $content);
        $content = str_replace("", '', $content);

        return $content;
    }
}
