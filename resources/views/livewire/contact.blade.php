<div class="max-w-screen-xl px-4 py-8 mx-auto space-y-6 sm:px-6 lg:px-8">
    <section class="mb-12 bg-indigo-600 text-white p-6 text-center rounded-lg">
        <h2 class="text-3xl font-bold">Get in touch</h2>
        <p class="mt-2 text-lg">Got a technical issue? Want to send feedback about a beta feature? Need details about our Business plan? Let us know.</p>
    </section>

    <section class="mb-12 divide-y grid grid-cols-1 gap-4 md:grid-cols-2">
        <div class="px-8">
            <p class="mb-3 text-sm">Drop a message and we will get back to you very soon</p>
            <form action="#" class="space-y-4">
                <x-input.group label="Email" :errors="$errors->get('email')" required>
                    <x-input.text wire:model.live="email" required />
                </x-input.group>
                <x-input.group label="Your message" :errors="$errors->get('message')" required>
                    <textarea wire:model.live="message" rows="6" class="w-full p-3 border border-gray-200 rounded-lg sm:text-sm" placeholder="Leave a comment..."></textarea>
                </x-input.group>
                <div class="mt-6 text-right">
                <button type="submit" class="py-3 px-5 text-sm font-medium text-white rounded-lg bg-indigo-600 hover:bg-indigo-700">Send message</button>
                </div>
            </form>
        </div>
        <div class="p-8 border-t md:border-l">
            <h2 class="text-2xl font-medium text-indigo-600 mb-4">Contact Us</h2>
            <p class="text-sm">If you have any questions or concerns or any urgent issue, please contact us at:</p>
            <p class="text-sm mt-2">Email: <a href="mailto:{{ env('SUPPORT_EMAIL') }}" class="text-indigo-600 hover:underline">{{ env('SUPPORT_EMAIL') }}</a></p>
            <p class="text-sm mt-2">Phone: +92 300 1234567</p>
        </div>
    </section>
</div>