# Statamic ChatGPT Add-on

> Statamic ChatGPT is a Statamic addon that allows you to generate content from ChatGPT from within the Bard editor from a prompt.

## Features

Some headline features:

* Generate a complete article from a single prompt
* Generate shorter single paragraphs for when you need help with a portion of an article
* Supports GPT4o, GPT4o-Mini, ChatGPT 3.5-turbo, and ChatGPT 4
* Will support future versions when they become available
* Add site-wide context to your prompts to get more tailored responses (for example, configure ChatGPT to think it is an expert on writing SEO-optimised articles about gardening, if that's your thing)
* Configure the maximum number of tokens to be used with each prompt in order to manage your spend
* Manage your API key and various options from within the dashboard

### Settings
![Screenshot](https://bitdigital.co.uk/statamic-chatgpt/statamic-chatgpt-screenshot-1.png)

### Icon added to Bard editor
![Screenshot](https://bitdigital.co.uk/statamic-chatgpt/statamic-chatgpt-screenshot-2.png)

### Modal allows you to generate a full article or just a paragraph
![Screenshot](https://bitdigital.co.uk/statamic-chatgpt/statamic-chatgpt-screenshot-3.png)

### Fully formatted article is added to Bard, ready for you to use or edit
![Screenshot](https://bitdigital.co.uk/statamic-chatgpt/statamic-chatgpt-screenshot-4.png)

### Also generate a single paragraph
![Screenshot](https://bitdigital.co.uk/statamic-chatgpt/statamic-chatgpt-screenshot-video-optimized-1.gif)


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

Although ChatGPT 4 is now generally available in the API, OpenAI does require a payment to have been made, so it won't work in the trial. If you want to use the trial without adding a payment method then you will need to use a different model.

> After about 2 minutes I get a message about the API timing out.

ChatGPT takes time to generate a response. We wait 2 minutes before giving up, this is usually plenty of time to get the response but if the API is under extreme load or is down then you may need to try again. If it persists check OpenAI status: https://status.openai.com/ 

> I'm getting an [Object object] error pop-up when using.

Please let us know what steps you took for this to happen. We handle all errors gracefully, and any that are introduced by the API should be displayed to you. If you're getting this error then it's likely something we haven't accounted for. Please raise an issue on Github and we'll look into it.
