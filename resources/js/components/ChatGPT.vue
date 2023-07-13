<template>
    <div class="addon-container">
        <button
            class="bard-toolbar-button"
            v-html="button.html"
            v-tooltip="button.text"
            @click="toggleDropdown"
        ></button>
        <div class="dropdown-container" v-if="showDropdown" v-click-outside="toggleDropdown">
            <div class="block mb-2">
                <p class="mb-2">What would you like to generate?</p>

                <label>
                    Full article
                    <input v-model="type" type="radio" value="full" class="border border-gray-500 rounded-sm p-2">
                </label>

                <label>
                    Paragraph
                    <input v-model="type" type="radio" value="paragraph" class="border border-gray-500 rounded-sm p-2">
                </label>
            </div>
            <label class="block mb-2">
                <template v-if="type == 'full'">
                    Enter an article title:
                </template>
                <template v-else>
                    Enter a prompt for the paragraph:
                </template>
                <input v-model="promptText" type="text" class="block w-full border border-gray-500 rounded-sm p-2">
            </label>

            <button @click="send" class="btn-primary">Generate</button>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'v-click-outside'
import axios from "axios";

export default {
    name: "ChatGPT",
    directives: {
        clickOutside: vClickOutside.directive
    },
    mixins: [BardToolbarButton],
    data() {
        return {
            showDropdown: false,
            promptText: '',
            type: 'full',
        };
    },
    methods: {
        toggleDropdown() {
            this.showDropdown = !this.showDropdown;
        },
        async send() {

            // Close dropdown
            this.toggleDropdown();

            // Don't touch the editor til we are waiting for the api response.
            this.editor.setEditable(false)

            // Prepare data to the api request
            const data = {
                'type': this.type,
                'promptText': this.promptText,
            }

            const that = this;

            await axios.post('/!/statamic-chatgpt', data).then(function (response) {
                if (response?.data) {
                    if (response?.data?.text) {
                        that.editor.commands.insertContent(response.data.text);
                    }

                    if (response?.data?.text) {
                        Statamic.$toast.success(__('Your content has been generated.'));
                    } else {
                        Statamic.$toast.error(response.data.error || __('Something went wrong.'), { duration: 10000 });
                    }
                }
            }).catch(function (error) {
                Statamic.$toast.error(error?.response?.data.error || error.message || __('Something went wrong.'), { duration: 10000 });
            }).finally(function () {
                that.editor.commands.focus();
                that.editor.setEditable(true);
            });
        }
    }
};
</script>

<style>
.addon-container {
    @apply inline-block relative;
}

.dropdown-container {
    @apply absolute bg-white border border-gray-300 rounded-sm z-10 divide-y divide-gray-100 shadow-lg p-3 min-w-[300px];
}

.button {
    @apply text-left px-3 py-2 w-full hover:bg-gray-100 flex items-center whitespace-nowrap;
}

.button.active {
    @apply bg-gray-200;
}

.ProseMirror[contenteditable="false"]::after {
    @apply absolute -mt-8 -ml-8 w-12 h-12 border-8 border-gray-400 rounded-full animate-spin inset-1/2 content-[''];
}

.ProseMirror[contenteditable="false"] {
    @apply bg-gray-200;
}
</style>
