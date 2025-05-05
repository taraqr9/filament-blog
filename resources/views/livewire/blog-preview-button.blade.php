<div>
    <x-filament::button color="info"
                        type="button"
                        wire:click="$dispatch('open-preview')"
                        class="filament-button filament-button-size-md filament-button-color-primary"
    >
        Preview
    </x-filament::button>

    <div
        x-data="{ show: false }"
        x-on:open-preview.window="show = true"
        x-show="show"
        x-cloak
        class="fixed inset-0 bg-black bg-opacity-70 flex justify-center items-center z-50"
    >
        <div class="bg-white rounded-xl overflow-hidden relative shadow-xl"
             style="width: 50vw !important; height: 90vh !important;">
            <button class="absolute top-3 right-4 ml-4 mt-4 font-bold z-10" @click="show = false">✖</button>
            <iframe
                class="w-full h-full"
                :src="(() => {
                    return `/live-preview?title=${encodeURIComponent(@this.get('data.title'))}&content=${encodeURIComponent(@this.get('data.content'))}`;
                })()"
            ></iframe>


        </div>

    </div>
</div>
