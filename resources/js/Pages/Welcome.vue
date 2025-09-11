<script>
import GuestLayout from '../Layouts/Guest.vue'
import Trophy from '../components/svg/Trophy.vue';
import Puzzle from '../components/svg/Puzzle.vue';
import Clipboard from '../components/svg/Clipboard.vue';
import Wallet from '../components/svg/Wallet.vue';
import Modal from '../components/Modal.vue';
import Instructions from '../components/Instructions.vue';
import PlayBox from '../components/PlayBox.vue';

export default {
    components: {
        GuestLayout, Trophy, Puzzle, Clipboard, Wallet, Modal, Instructions, PlayBox
    },
    props: {
        url: String
    },
    data() {
        return {
            menu: [
                {
                    name: 'View All Levels',
                    link: null,
                    icon: 'Wallet'
                },
                {
                    name: 'Jump to Random Puzzle',
                    link: null,
                    icon: 'Puzzle'
                },
                {
                    name: 'View Global Leaderboards',
                    link: null,
                    icon: 'Trophy'
                },
                {
                    name: 'View my Stats',
                    link: null,
                    icon: 'Clipboard'
                }
            ],
            modals: {
                instructions: {
                    show: false,
                    title: 'Instructions'
                }
            }
        }
    },
}
</script>

<template>
    <GuestLayout>
        <template v-slot:content>
            <div class="flex flex-col h-full min-h-[1080px] justify-evenly space-y-8">
                <div class="flex flex-col justify-center space-y-2">
                    <h2 class="font-semibold text-xl">Welcome.</h2>
                    <h3 class="font-semibold text-lg">Ready to play?</h3>
                    <p>Test your pattern recognition skills with these free and fun puzzles. Level up and compete globally for top spot on our leaderboard, and embrace the fame that follows!</p>
                </div>
                <div class="flex flex-col space-y-3 items-center">
                    <template v-for="item in menu">
                        <button class="flex items-center border rounded-md w-[275px] py-1 hover:bg-indigo-300 cursor-pointer hover:scale-[1.05] shadow shadow-black px-1">
                            <component :is="item.icon" class="w-6 h-6" fill="none" stroke="#000000" stroke-width="1.5"></component>
                            <span class="ml-4" v-text="item.name"></span>
                        </button>
                    </template>
                </div>
                <div class="flex items-center mx-auto w-full max-w-[1000px]">
                    <div class="border aspect-video w-full shadow shadow-black">
                        <PlayBox />
                    </div>
                </div>
                <div class="grid place-content-center">
                    <small @click="modals.instructions.show=true" class="hover:underline underline-offset-2 decoration-2 cursor-pointer font-semibold">Need Help? Click for instructions.</small>
                </div>
                <video width="400" height="400" autoplay muted loop :src="url"></video>
                <Modal :title="modals.instructions.title" :show="modals.instructions.show" @closeModal="modals.instructions.show=false">
                    <template v-slot:content>
                        <Instructions />
                    </template>
                </Modal>
            </div>
        </template>
    </GuestLayout>
</template>