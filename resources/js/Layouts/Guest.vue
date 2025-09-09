<template>
    <main class="flex flex-col h-full">
        <div class="min-h-[60px] h-[60px] shadow shadow-black z-10 flex items-center justify-center bg-indigo-200">
            <h1 class="font-bold text-2xl">Video Tiles</h1>
        </div>
        <div class="bg-indigo-100 grow py-8 px-4 md:px-0">
            <div class="w-full md:w-3/4 mx-auto h-full">
                <slot name="content" />
            </div>
        </div>
    </main>
</template>