# Statamic ChatGPT Add-on

> Statamic ChatGPT is a Statamic addon that allows you to generate content from ChatGPT from within the Bard editor from a prompt.

## Features

Some headline features:
- Generate a complete article from a single prompt
- Generate shorter single paragraphs for when you need help with a portion of an article
- Supports ChatGPT 3.5-turbo, and ChatGPT 4
- Will support future versions when they become available
- Add site-wide context to your prompts to get more tailored responses (for example, configure ChatGPT to think it is an expert on writing SEO-optimised articles about gardening, if that's your thing)
- Configure the maximum number of tokens to be used with each prompt in order to manage your spend
- Manage your API key and various options from within the dashboard

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require bitdigitalcodes/statamic-chatgpt
```

You will need to add your API key before the addon will work.

## How to Use

1. Once installed you should see a new 'ChatGPT' menu option on the left of the control panel. Click it.
2. Enter your API key (https://platform.openai.com/signup if you don't have one already).
3. Select the model to use. If you're opting for ChatGPT 4 you may need to make a payment to get access.
4. Select the max tokens, or use defaults.
5. Give ChatGPT a bit of context about your site and the text you want it to write.
6. Save the config.
7. You'll now get a ChatGPT icon on any Bard editor. Click this for access to all features.

## Troubleshooting

> I'm getting an error mentioning my API key.
You probably haven't set up your API key properly in the control panel. Head to https://platform.openai.com/signup, get an API key, and carefully copy it across. You may also be using an API key that doesn't support ChatGPT 4, in which case try selecting a different model.

> I'm getting an [Object object] error pop-up when using.
We try and handle all errors returned by the ChatGPT API gracefully, but any new ones, or if the API itself is down (which happens a lot) may results in this error. Check your `/storage/logs/laravel.log` file for more info on what's wrong.