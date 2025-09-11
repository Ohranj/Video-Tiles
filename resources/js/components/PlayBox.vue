<script>
export default {
    data() {
        return {
            frameInterval: null,
            elements: {
                video: null,
                canvas: null
            }
        }
    },
    methods: {
        setEventListeners() {
            this.elements.video.addEventListener('loadeddata', () => {
                const {canvas, video} = this.elements;
                if (video.readyState >= 1) {
                    this.frameInterval = setInterval(() => {
                        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height)
                    }, 1000 / 30)
                }
            })
        }
    },
    mounted() {
        this.elements.video = document.querySelector('video')
        this.elements.canvas = document.querySelector('canvas')
        const canvasParent = this.elements.canvas.parentElement;
        this.elements.canvas.setAttribute('width', canvasParent.offsetWidth)
        this.elements.canvas.setAttribute('height', canvasParent.offsetHeight)
        this.setEventListeners()
    },
}
</script>

<template>
    <canvas class="rounded shadow shadow-black"></canvas>
</template>